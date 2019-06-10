<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['text','story_id','user_id'];
    
    public function story(){
        return $this->belongsTo('App\Story');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function ratings(){
        return $this->morphToMany('App\User','rateable')
            ->using('App\RateablePivot')
            ->withPivot('like');
    }
}
