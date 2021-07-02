<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', 0)->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function detail(User $user)
    {
        return view('admin.users.detail', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required'
        ]);
        $user->update([
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone
        ]);
        return back()->with('message', 'Success to update');
    }

    public function status(User $user)
    {
        return view('admin.users.status', compact('user'));
    }

    public function updateStatus(User $user, Request $request)
    {
        $user->update([
            'is_active' => $request->is_active ? 1 : 0,
        ]);

        return back()->with('message', 'Success to update');
    }

    public function invoices(User $user)
    {
        return view('admin.users.invoice', compact('user'));
    }

    public function courses(User $user)
    {
        $courses = DB::table('learning_records')
            ->join('users', 'users.id','=','learning_records.student_id')
            ->join('courses', 'courses.id', '=','learning_records.course_id')
            ->where('users.id','=', $user->id)
            ->select('courses.*')
            ->distinct()
            ->latest('learning_records.created_at')
            ->paginate(10);

        return view('admin.users.course', compact('user', 'courses'));
    }

    public function subscriptions(User $user)
    {
        return view('admin.users.subscription', compact('user'));
    }
}
