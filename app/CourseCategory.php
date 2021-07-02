<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'tag';
    }

    public function courses(  ) {
        return $this->hasMany(Course::class);
    }

    public function courseshomepage(  ) {
        return $this->hasMany(Course::class)->latest();
    }
}
