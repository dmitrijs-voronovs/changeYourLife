<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable=['word'];
    
    public function stories(){
        return $this->belongsToMany('App\Story','story_keyword');
    }
    
    public function followers(){
        return $this->morphToMany('App\User','followable');
    }
}
