<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sentence extends Model
{
    use SoftDeletes;
    protected $fillable=['text','author_id','story_id'];
    public function author(){
        return $this->belongsTo('App\User');
    }

    public function story(){
        return $this->belongsTo('App\Story');
    }
    
    public function ratings(){
        return $this->morphToMany('App\User','rateable')
            ->using('App\RateablePivot')
            ->withPivot('like');
    }
}
