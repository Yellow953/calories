<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->cookie('language', 'en');
        app()->setLocale($locale);

        $currency = $request->cookie('currency', 'USD');
        view()->share('currency', $currency);

        return $next($request);
    }
}
