<?php

namespace App\Http\Middleware;

use Closure;

class LastSentenceOnFinishedStoryByOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $sentence_id = $request->route()->parameter('sentence');
        $story = \App\Sentence::findOrFail($sentence_id)->story;
        $querry = \DB::table('sentences')->where('story_id',$story->story_id);
        // dd($querry,$querry->orderBy('created_at','asc')->first());
        if($story->finished && $querry->latest()->first()->id == $sentence_id)
        abort(403, 'The latest sentence of the finished story can not be modified.');   
        return $next($request);
    }
}
