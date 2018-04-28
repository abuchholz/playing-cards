<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SeleniumAuth
{

    public function handle($request, Closure $next)
    {
        if ((app()->isLocal() || app()->runningUnitTests()) && isset($_COOKIE['selenium_auth'])) {
            Auth::loginUsingId((int)$_COOKIE['selenium_auth']);
        }

        return $next($request);
    }

}