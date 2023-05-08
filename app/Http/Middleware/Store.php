<?php

namespace App\Http\Middleware;

use Closure;

class Store
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
        if (auth()->user()->level_id == 1 || auth()->user()->level_id == 2) {
            return $next($request);
        } else return abort(404);
    }
}
