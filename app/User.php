<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function isAdmin(){
        return $this->role === 'admin';
    }

    public function stories(){
        return $this->hasMany('App\Story');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function sentences(){
        return $this->hasMany('App\Sentence');
    }

    public function followed_keywords(){
        return $this->morphedByMany('App\Keyword','followable');
    }

    public function followed_users(){
        return $this->morphedByMany('App\User','followable');
    }

    public function followers(){
        return $this->morphToMany('App\User','followable');
    }

    public function rated_comment(){
        return $this->morphedByMany('App\Comment','rateable');
    }

    public function rated_sentence(){
        return $this->morphedByMany('App\User','rateable');
    }

    public function rated_story(){
        return $this->morphedByMany('App\User','rateable');
    }
}
