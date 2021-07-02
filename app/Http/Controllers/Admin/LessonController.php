<?php

namespace App\Http\Controllers\Admin;

use App\Chapter;
use App\Course;
use App\FileUpload;
use App\Http\Controllers\Controller;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function detail(Course $course, Chapter $chapter, Lesson $lesson)
    {
        return view('admin.courses.chapters.lessons.detail', compact('course', 'chapter', 'lesson'));
    }

    public function store(Course $course, Chapter $chapter, Request $request)
    {
        if($request->video_url) {
            if (!$request->is_free && !strpos($request->video_url, 'vimeo.com'))
                return back()->with('err_message', 'Only Use Vimeo for paid video!');
        }

        $course->update([
            'lesson_count' => $course->lesson_count + 1
        ]);

        $lesson = Lesson::create([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => \Illuminate\Support\Str::slug($request->title, '-','en'),
            'minutes_length' => $request->minutes_length,
            'video_url' => $request->video_url,
            'resource' => $request->resource,
            'is_free' => $request->is_free ? 1 : 0,
            'order' => $request->order,
            'chapter_id' => $chapter->id,
            'course_id' => $course->id,
//            'poster' => $request->file ? $this->fileUpload($request) : null,
        ]);

        return redirect()->route('admin.courses.chapters.lessons.detail', [$course, $chapter, $lesson]);
    }

    public function update(Course $course, Chapter $chapter, Lesson $lesson, Request $request)
    {
        if($request->video_url) {
            if (!$request->is_free && !strpos($request->video_url, 'vimeo.com'))
                return back()->with('err_message', 'Only Use Vimeo for paid video!');
        }

        $request->validate([
            'chapter' => 'required',
        ]);

        if($lesson->poster && $request->file)
        {
            Storage::disk('s3')->delete($lesson->poster);
        }

        $lesson->update([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => \Illuminate\Support\Str::slug($request->title, '-','en'),
            'minutes_length' => $request->minutes_length,
            'video_url' => $request->video_url,
            'resource' => $request->resource,
            'is_free' => $request->is_free ? 1 : 0,
            'order' => $request->order,
            'chapter_id' => $request->chapter,
            'course_id' => $course->id,
//            'poster' => $request->file ? $this->fileUpload($request) : $lesson->poster,
        ]);

        $chapter = Chapter::find($request->chapter);

        return redirect()->route('admin.courses.chapters.lessons.detail', [$course, $chapter, $lesson]);
    }

    public function fileUpload(Request $request)
    {
        $path = Storage::disk('s3')->put('images/video/posters', $request->file, 'public');
        $request->merge([
            'size' => $request->file->getSize(),
            'path' => $path
        ]);
        $file = FileUpload::create($request->only('path', 'title', 'size'));
        return $file->path;
    }

    public function delete(Course $course, Chapter $chapter, Lesson $lesson, Request $request)
    {
        if($course->lesson_count > 0)
        {
            $course->update([
                'lesson_count' => $course->lesson_count - 1
            ]);
        }

        if($lesson->poster)
        {
            Storage::disk('s3')->delete($lesson->poster);
        }

        $lesson->delete();

        return redirect()->route('admin.courses.chapters.detail', [$course, $chapter]);
    }
}
