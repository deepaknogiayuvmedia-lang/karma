<?php

namespace App\Http\Middleware;

use App\Model\BusinessSetting;
use Closure;
use Illuminate\Support\Facades\App;

class Localization
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
        $status = BusinessSetting::where('type', 'language_status')->first();
        if (!isset($status) || $status->value != 1) {
            App::setLocale('en');
            return $next($request);
        }

        if (session()->has('local')) {
            App::setLocale(session()->get('local'));
        } elseif (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
        return $next($request);
    }
}
