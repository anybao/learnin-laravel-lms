<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'last_login', 'count_login', 'is_active', 'is_funded_active', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function isFundedActive()
    {
        return $this->is_funded_active;
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'buyer_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'learning_records','student_id','id','lesson_id','id')->latest();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
