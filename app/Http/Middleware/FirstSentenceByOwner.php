<?php

namespace App\Http\Middleware;

use Closure;

class FirstSentenceByOwner
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
        $story_id = \App\Sentence::findOrFail($sentence_id)->story_id;
        $querry = \DB::table('sentences')->where('story_id',$story_id);
        if($querry->oldest()->first()->id == $sentence_id)
        abort(403, 'The first sentence of the story can not be modified.');   
        return $next($request);
    }
}
