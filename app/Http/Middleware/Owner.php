<?php

namespace App\Http\Middleware;

use Closure;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $resourceName, $tableName)
    {
        $resourceId = $request->route()->parameter($resourceName);

        $user_id = \DB::table($tableName)->find($resourceId)->user_id;
        if ($request->user()->id == $user_id || $request->user()->isAdmin()) {
            return $next($request);            
        }
        abort(403, 'Unauthorized action.');
    }
}
