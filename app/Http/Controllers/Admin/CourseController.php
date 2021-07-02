<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\CourseCategory;
use App\FileUpload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    public function edit(Course $course)
    {
        $categories = CourseCategory::latest()->paginate(20);
        $this->updateCache();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function add()
    {
        $categories = CourseCategory::latest()->paginate(20);
        $this->updateCache();
        return view('admin.courses.add', compact('categories'));
    }

    public function updateCache()
    {
        $categories_cache = \App\CourseCategory::orderBy('order', 'ASC')->with('courseshomepage')->get()->toArray();
        Cache::put('categories::courses:all', $categories_cache);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'minute_length' => 'required',
        ]);

        $course = Course::create([
            'title' => $request->title,
            'body' => $request->body,
            'course_category_id' => $request->course_category_id,
            'minute_length' => $request->minute_length,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'is_featured' => $request->is_featured ? 1 : 0,
            'is_displayed' => $request->is_displayed ? 1 : 0,
            'author_id' => auth()->id(),
            'price' => 0,
            'slug' => \Illuminate\Support\Str::slug($request->title, '-','en'),
            'cover_img' => $request->file ? $this->fileUpload($request) : null,
        ]);

        $this->updateCache();
        return redirect()->route('admin.courses.detail', $course);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            'minute_length' => 'required'
        ]);

        if($course->cover_img && $request->file)
        {
            Storage::disk('s3')->delete($course->cover_img);
        }

        $course->update([
            'title' => $request->title,
            'body' => $request->body,
            'minute_length' => $request->minute_length,
            'is_featured' => $request->is_featured ? 1 : 0,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'course_category_id' => $request->course_category_id,
            'is_displayed' => $request->is_displayed ? 1 : 0,
            'slug' => \Illuminate\Support\Str::slug($request->title, '-','en'),
            'cover_img' => $request->file ? $this->fileUpload($request) : $course->cover_img,
        ]);

        $this->updateCache();
        return redirect()->route('admin.courses.detail', $course);
    }

    public function delete(Course $course)
    {
        if($course->cover_img)
        {
            Storage::disk('s3')->delete($course->cover_img);
        }
        $course->delete();
        $this->updateCache();
        return redirect()->route('admin.courses');
    }

    public function fileUpload(Request $request)
    {
        $path = Storage::disk('s3')->put('images/originals', $request->file, 'public');
        $request->merge([
            'size' => $request->file->getSize(),
            'path' => $path
        ]);
        $file = FileUpload::create($request->only('path', 'title', 'size'));
        return $file->path;
    }

    public function detail(Course $course)
    {
        return view('admin.courses.detail', compact('course'));
    }

    public function publish(Course $course)
    {
        $course->update(['is_draft' => 0]);
        $this->updateCache();
        return back();
    }

    public function unPublish(Course $course)
    {
        $course->update(['is_draft' => 1]);
        $this->updateCache();
        return back();
    }

    public function categories()
    {
        $categories = CourseCategory::orderBy('order', 'asc')->paginate(20);
        return view('admin.courses.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'tag'   => 'required',
        ]);

        CourseCategory::create([
            'title' => $request->title,
            'tag' => $request->tag,
            'order' => $request->order,
            'except' => $request->except
        ]);
        $this->updateCache();

        return back()->with('message', 'Success');
    }

    public function updateCategory(CourseCategory $category, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'tag'   => 'required',
        ]);

        $category->update([
            'title' => $request->title,
            'tag' => $request->tag,
            'order' => $request->order,
            'except' => $request->except
        ]);

        $this->updateCache();
        return back()->with('message', 'Success');
    }

    public function deleteCategory(CourseCategory $category)
    {
        $category->delete();
        $this->updateCache();

        return back();
    }

    public function viewCategory( CourseCategory $category ) {
        return view('admin.courses.categories.view', compact('category'));
    }
}
