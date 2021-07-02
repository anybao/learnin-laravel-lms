<?php

use App\Course;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $featured_course = Course::where('is_displayed', 1)->where('is_featured', 1)->first();

    $categories = Cache::get('categories::courses:all');
    if(!$categories)
    {
        $categories = \App\CourseCategory::orderBy('order', 'ASC')->with('courseshomepage')->get()->toArray();
        Cache::put('categories::courses:all', $categories);
    }

    return view('welcome', compact( 'featured_course', 'categories'));
})->name('index');

Route::get('courses', 'HomeController@courses')->name('courses');
Route::get('courses/{course}', 'HomeController@courseView')->name('courses.view');
Route::get('courses-category/{category}', 'HomeController@courseCategories')->name('courses.categories.view');
Route::get('courses/{course}/lesson/{lesson}', 'HomeController@lessonView')->name('courses.lesson.view');
Route::get('teacher', 'HomeController@teacherInfo')->name('teacher');
Route::get('search', 'HomeController@search')->name('search');

Route::get('terms', function(){
    return view('terms');
})->name('terms');
Route::get('privacy', function(){
    return view('privacy');
})->name('privacy');
Route::get('contact', function(){
    return view('contact');
})->name('contact');

// profile
Route::middleware('auth')->group(function(){
    Route::get('profile','HomeController@profile')->name('profile');
    Route::get('profile/edit','HomeController@profileEdit')->name('profile.edit');
    Route::put('profile/edit','HomeController@profileUpdate')->name('profile.edit');
    Route::get('profile/password','HomeController@profilePassword')->name('profile.password');
    Route::put('profile/password','HomeController@profilePasswordUpdate')->name('profile.password');
    Route::get('profile/lessons','HomeController@profileLessons')->name('profile.lessons');
    Route::get('profile/payment','HomeController@profilePayment')->name('profile.payment');
    Route::get('profile/subscription','HomeController@profileSubscription')->name('profile.subscription');
});

Route::get('subscribe/{amount?}','HomeController@subscribe')->name('subscribe');
Route::post('subscribe/{amount?}','HomeController@postSubscribe')->name('subscribe');
Route::get('subscribe-success/{invoice}','HomeController@subscribeSuccess')->name('subscribe.success');


Route::post('/payment/paypal', 'PaymentController@payWithpaypal')->name('payment.paypal');
// route for check status of the payment
Route::get('status/{invoice}', 'PaymentController@getPaymentStatus');


Auth::routes(['verify' => true]);

Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::prefix('admin')->group(function(){
        Route::get('', 'Admin\DashboardController@index')->name('admin.index');
        Route::get('invoices', 'Admin\InvoiceController@index')->name('admin.invoices');
        Route::get('invoices/{invoice}', 'Admin\InvoiceController@detail')->name('admin.invoices.detail');
        Route::put('invoices/{invoice}/verify', 'Admin\InvoiceController@verify')->name('admin.invoices.verify');

        //Courses
        Route::get('courses', 'Admin\CourseController@index')->name('admin.courses');
        Route::get('courses/add', 'Admin\CourseController@add')->name('admin.courses.add');
        Route::post('courses/add', 'Admin\CourseController@store')->name('admin.courses.store');
        Route::get('courses/edit/{course}', 'Admin\CourseController@edit')->name('admin.courses.edit');
        Route::put('courses/edit/{course}', 'Admin\CourseController@update')->name('admin.courses.update');
        Route::delete('courses/detail/{course}', 'Admin\CourseController@delete')->name('admin.courses.detail');
        Route::get('courses/detail/{course}', 'Admin\CourseController@detail')->name('admin.courses.detail');
        Route::post('courses/publish/{course}', 'Admin\CourseController@publish')->name('admin.courses.publish');
        Route::post('courses/unpublish/{course}', 'Admin\CourseController@unPublish')->name('admin.courses.unpublish');

        // Course Category
        Route::get('courses/categories', 'Admin\CourseController@categories')->name('admin.courses.categories');
        Route::post('courses/categories', 'Admin\CourseController@storeCategory')->name('admin.courses.categories.add');
        Route::put('courses/categories/{category}', 'Admin\CourseController@updateCategory')->name('admin.courses.categories.update');
        Route::get('courses/categories/{category}', 'Admin\CourseController@viewCategory')->name('admin.courses.categories.detail');
        Route::delete('courses/categories/{category}', 'Admin\CourseController@deleteCategory')->name('admin.courses.categories.delete');

        // Chapter
        Route::post('courses/detail/{course}/chapters', 'Admin\ChapterController@add')->name('admin.courses.chapter.add');
        Route::put('courses/detail/{course}/chapters/{chapter}', 'Admin\ChapterController@update')->name('admin.courses.chapter.detail');
        Route::get('courses/detail/{course}/chapters/{chapter}','Admin\ChapterController@detail')->name('admin.courses.chapters.detail');
        Route::delete('courses/detail/{course}/chapters/{chapter}','Admin\ChapterController@delete')->name('admin.courses.chapters.detail');

        // Lesson
        Route::get('courses/detail/{course}/chapters/{chapter}/lessons/{lesson}','Admin\LessonController@detail')->name('admin.courses.chapters.lessons.detail');
        Route::put('courses/detail/{course}/chapters/{chapter}/lessons/{lesson}','Admin\LessonController@update')->name('admin.courses.chapters.lessons.detail');
        Route::delete('courses/detail/{course}/chapters/{chapter}/lessons/{lesson}','Admin\LessonController@delete')->name('admin.courses.chapters.lessons.detail');
        Route::post('courses/detail/{course}/chapters/{chapter}/lessons','Admin\LessonController@store')->name('admin.courses.chapters.lessons.add');

        // Files
        Route::get('files', 'Admin\DashboardController@files')->name('admin.files');

        Route::get('users', 'Admin\UserController@index')->name('admin.users');
        Route::get('users/detail/{user}', 'Admin\UserController@detail')->name('admin.users.detail');
        Route::get('users/edit/{user}', 'Admin\UserController@edit')->name('admin.users.edit');
        Route::put('users/edit/{user}', 'Admin\UserController@update')->name('admin.users.edit');
        Route::get('users/status/{user}', 'Admin\UserController@status')->name('admin.users.status');
        Route::put('users/status/{user}', 'Admin\UserController@updateStatus')->name('admin.users.status');
        Route::get('users/courses/{user}', 'Admin\UserController@courses')->name('admin.users.courses');
        Route::get('users/invoices/{user}', 'Admin\UserController@invoices')->name('admin.users.invoices');
        Route::get('users/subscriptions/{user}', 'Admin\UserController@subscriptions')->name('admin.users.subscriptions');

        // Subscriptions
        Route::get('subscriptions', 'Admin\SubscriptionController@index')->name('admin.subscriptions');
    });
});

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});
