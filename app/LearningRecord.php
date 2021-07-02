<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningRecord extends Model
{
    protected $guarded = ['id'];

    public function getCompletedLessonByUser(Course $course, User $user)
    {
        return LearningRecord::where('student_id', $user->id)->where('course_id', $course->id)->count();
    }
}
