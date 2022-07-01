<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Setlang
{

    public function handle($request, Closure $next)
    {
        if (!empty(session('lang'))) {
            App::setLocale(session('lang'));
        }
        return $next($request);
    }
}
