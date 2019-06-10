<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    protected $fillable=['text','author_id','prev_sentence_id','story_id'];
    public function author(){
        return $this->belongsTo('App\User');
    }

    public function story(){
        return $this->belongsTo('App\Story');
    }

    public function parent(){
        return $this->BelongsTo('App\Sentence','prev_sentence_id');
    }

    public function previous_sentence(){
        return $this->hasOne('App\Sentence','prev_sentence_id');
    }
    
    public function ratings(){
        return $this->morphToMany('App\User','rateable');
    }
}
