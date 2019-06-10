<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable=['title','user_id'];
    public function author(){
        return $this->belongsTo('App\User','user_id');
    }

    public function keywords(){
        return $this->belongsToMany('App\Keyword','story_keyword');
    }
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function sentences(){
        return $this->hasMany('App\Sentence');
    }
        
    public function ratings(){
        return $this->morphToMany('App\User','rateable');
    }
}
