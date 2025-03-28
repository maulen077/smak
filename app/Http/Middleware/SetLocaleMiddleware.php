<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale') ?? Session::get('locale', 'ru'); // Берем язык из URL или сессии

        if (!in_array($locale, ['ru', 'kk', 'en'])) {
            $locale = 'ru'; // Если язык некорректен, используем русский
        }

        App::setLocale($locale);

        return $next($request);
    }
}
