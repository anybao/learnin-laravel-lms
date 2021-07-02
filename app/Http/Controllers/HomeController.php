<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseCategory;
use App\FileUpload;
use App\Invoice;
use App\LearningRecord;
use App\Lesson;
use App\Notifications\NotifyAdminNewPayment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['courses', 'courseView', 'lessonView', 'courseCategories', 'teacherInfo', 'search']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->isAdmin())
            return redirect()->route('admin.index');
        return view('user.home');
    }

    public function courses()
    {
        $courses = Course::where('is_displayed', 1)->latest()->paginate(9);
        return view('user.courses.index', compact('courses'));
    }

    public function courseCategories(CourseCategory $category)
    {
        $courses = Course::where('course_category_id', $category->id)->latest()->paginate(9);
        return view('user.courses.index', compact('courses', 'category'));
    }

    public function courseView(Course $course)
    {
        if($course->isDisplayed())
        {
            return view('user.courses.view', compact('course'));
        }
        return abort(404);
    }

    public function lessonView(Course $course, Lesson $lesson)
    {
        if(auth()->check())
        {
            $log = LearningRecord::where('course_id', $course->id)->where('lesson_id', $lesson->id)->where('student_id', auth()->id())->first();
            if(!$log)
            {
                LearningRecord::create([
                    'student_id' => auth()->id(),
                    'course_id' => $course->id,
                    'lesson_id' => $lesson->id
                ]);
            }
        }
        return view('user.courses.lessons.view', compact('course', 'lesson'));
    }

    public function profile(){
        $courses = DB::table('learning_records')
                     ->join('users', 'users.id','=','learning_records.student_id')
                     ->join('courses', 'courses.id', '=','learning_records.course_id')
                     ->where('users.id','=',auth()->id())
                     ->where('is_displayed', 1)
                     ->select('courses.*')
                     ->distinct()
                     ->latest('learning_records.created_at')
                     ->paginate(10);

        return view('user.profile.lessons', compact('courses'));
    }

    public function profileEdit()
    {
        $user = auth()->user();
        return view('user.profile.edit', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('message', 'Cập nhật thành công!');
    }

    public function profilePassword()
    {
        return view('user.profile.password');
    }

    public function profilePasswordUpdate(Request $request)
    {
        // check password old match
        if(!Hash::check(request('password_old'), auth()->user()->getAuthPassword()))
            return back()->with('err_message', 'Mật khẩu cũng không đúng');

        if(request('password') != request('password_confirmation'))
            return back()->with('err_message', 'Mật khẩu không khớp');

        elseif(strlen(request('password')) < 8 || strlen(request('password_new')) > 16)
            return back()->with('er_message', 'Độ dài mật khẩu 8-16 ký tự');

        // update new password
        else
        {
            auth()->user()->update([
                'password' => bcrypt(request('password'))
            ]);

            return back()->with('message', 'Đổi mật khẩu thành công!');
        }
    }

    public function profileLessons()
    {
        $courses = DB::table('learning_records')
            ->join('users', 'users.id','=','learning_records.student_id')
            ->join('courses', 'courses.id', '=','learning_records.course_id')
            ->where('users.id','=',auth()->id())
            ->where('is_displayed', 1)
            ->select('courses.*')
            ->distinct()
            ->latest('learning_records.created_at')
            ->paginate(10);

        return view('user.profile.lessons', compact('courses'));
    }

    public function profilePayment()
    {
        $invoices = Invoice::whereIn('status', ['completed', 'new'])->where('buyer_id', auth()->id())->latest()->get();
        return view('user.profile.payment', compact('invoices'));
    }

    public function subscribe()
    {
        return view('user.subscribe');
    }

    public function profileSubscription()
    {
        return view('user.profile.subscription');
    }

    public function postSubscribe(Request $request)
    {
        $request->validate([
            'amount' => 'required|in:99,299,499',
            'month' => 'required|in:1,3,6'
        ]);

        // Create subscription object
        $invoice = Invoice::where('buyer_id', auth()->id())
            ->where('payment_method', 'bank_transfer')
            ->where('status', 'new')
            ->where('verified_by', null)
            ->where('grand_total', $request->amount*1000)
            ->where('amount', $request->amount)
            ->where('month', $request->month)
            ->first();

        if(!$invoice){
            $invoice = Invoice::create([
                'buyer_id' => auth()->id(),
                'payment_method' => 'bank_transfer',
                'status' => 'new',
                'code' => $this->generateInvoiceCode(),
                'amount' => $request->amount,
                'month' => $request->month,
                'grand_total' => $request->amount*1000,
                'bank_transfer_path' => $request->file ? $this->fileUpload($request) : null,
            ]);
        } else {
            $invoice->update([
                'status' => 'new',
                'amount' => $request->amount,
                'month' => $request->month,
                'grand_total' => $request->amount*1000,
                'bank_transfer_path' => $request->file ? $this->fileUpload($request) : null,
            ]);
        }

        (new User)->forceFill([
            'name' => 'DTVP Website',
            'email' =>  env('MAIL_FROM_ADDRESS', 'tranquanghuy1093@gmail.com')
        ])->notify(new NotifyAdminNewPayment($invoice));

        return redirect()->route('subscribe.success', $invoice)->with('message', 'Vui lòng chờ! Chúng tôi đang xác thực giao dịch của bạn.');
    }

    public function subscribeSuccess(Invoice $invoice)
    {
        return view('user.subscribe-success', compact('invoice'));
    }

    public function generateInvoiceCode(  ) {
        return auth()->id().strtotime(Carbon::now());
    }

    public function fileUpload(Request $request)
    {
        $path = Storage::disk('s3')->put('images/banktransfer', $request->file, 'public');
        $request->merge([
            'size' => $request->file->getSize(),
            'path' => $path
        ]);
        $file = FileUpload::create($request->only('path', 'title', 'size'));
        return $file->path;
    }

    public function teacherInfo(  ) {
        return view('teacher');
    }

    public function search(Request $request)
    {
        $result_courses = null;
        if ($request->keywords && strlen($request->keywords) > 2)
        {
            $result_courses = Course::where('title', 'LIKE', '%'.$request->keywords.'%')->where('is_displayed', 1)->paginate(10);
        }

        return view('search', compact('result_courses'));
    }
}
