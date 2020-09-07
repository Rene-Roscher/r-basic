<?php

namespace RServices\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetUserLocale
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
        if (auth()->guest())
            return $next($request);
        App::setLocale(auth()->user()->language ?: 'en');
        return $next($request);
    }
}
