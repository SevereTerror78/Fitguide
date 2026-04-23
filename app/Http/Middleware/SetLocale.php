<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = 'en';

        if (Auth::check() && in_array(Auth::user()->language, ['en', 'hu'], true)) {
            $locale = Auth::user()->language;
        } elseif ($request->session()->has('locale') && in_array($request->session()->get('locale'), ['en', 'hu'], true)) {
            $locale = $request->session()->get('locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}