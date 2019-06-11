<?php

namespace App\Http\Middleware;

use Closure;

class LastSentenceFromAnotherUser
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
        $story_id = $request->route()->parameter('story');
        // dd($story_id);
        if(\App\Story::findOrFail($story_id)->sentences->last()->author_id == $request->user()->id) abort(403, 'Your sentence is the latest in the story. Please, wait for other users to append the story.');   
        return $next($request);
    }
}
