<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckType
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
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
