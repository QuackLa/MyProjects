<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;

class ChangeLanguage
{
    // Язык по умолчанию
    protected $default = 'ru';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Устанавливаем язык. Его может выбрать юзер, иначе будет использован дефолт ($default)
        App::setLocale(session()->get('language') ?? $this->default);
        return $next($request);;
    }
}
