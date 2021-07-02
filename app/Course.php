<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isDraft()
    {
        return $this->is_draft;
    }

    public function isDisplayed()
    {
        return $this->is_displayed;
    }

    public function isFeatured()
    {
        return $this->is_featured;
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function getCompletedLessonByUser(User $user)
    {
        return LearningRecord::where('student_id', $user->id)->where('course_id', $this->id)->count();
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
