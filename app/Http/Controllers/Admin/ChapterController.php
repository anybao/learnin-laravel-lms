<?php

namespace App\Http\Controllers\Admin;

use App\Chapter;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function add(Request $request, Course $course)
    {
        Chapter::create([
            'title' => $request->title,
            'body'  => $request->body,
            'course_id' => $course->id,
        ]);

        return back();
    }

    public function update(Request $request, Course $course, Chapter $chapter)
    {
        $chapter->update([
            'title' => $request->title,
            'body'  => $request->body,
            'course_id' => $course->id,
        ]);

        return back();
    }

    public function detail(Course $course, Chapter $chapter)
    {
        return view('admin.courses.chapters.detail', compact('course','chapter'));
    }

    public function delete(Course $course, Chapter $chapter)
    {
        $chapter->delete();

        return redirect()->route('admin.courses.detail', $course);
    }
}
