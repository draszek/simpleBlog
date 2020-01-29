<?php

namespace App\Http\Middleware;

use Closure;

class CheckType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if (!$request->user()->hasType($type)) {
            return route('login');
        }

        return $next($request);
    }
}
