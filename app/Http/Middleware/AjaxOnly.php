<?php


namespace RServices\Http\Middleware;


use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AjaxOnly
{

    public function handle($request, Closure $next)
    {
        abort_if(!$request->ajax(), 404);
        return $next($request);
    }

}
