<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Check which guard is being used and redirect to appropriate login
            if ($request->is('delivery-man/*') || $request->is('delivery-man')) {
                return route('delivery-man.auth.login');
            }
            if ($request->is('seller/*') || $request->is('seller')) {
                return route('seller.auth.login');
            }
            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.auth.login');
            }
            return route('authentication-failed');
        }
    }
}
