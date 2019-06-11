<?php

namespace App\Http\Middleware;

use Closure;

class StoryOrSentenceAuthor
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
        $sentence = \App\Sentence::findOrFail($sentence_id);
        $story_author= $sentence->story->user_id;
        $sentence_author = $sentence->author_id;
        $user = $request->user()->id;
        if($user == $story_author || $user == $sentence_author)
        return $next($request);
        else abort(403, 'You do not have the right permission to edit this sentence.');
    }
}
