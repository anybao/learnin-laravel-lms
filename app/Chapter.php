<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class)->orderBy('order','ASC');
    }
}
