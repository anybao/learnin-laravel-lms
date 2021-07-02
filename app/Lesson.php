<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = ['id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function isFree()
    {
        return $this->is_free;
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function next()
    {
        return Lesson::where('course_id', $this->course->id)->where('id', '>', $this->id)->first();
    }

    public function previous()
    {
        return Lesson::where('course_id', $this->course->id)->where('id', '<', $this->id)->first();
    }
}
