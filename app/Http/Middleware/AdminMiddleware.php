<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            // A deactivated admin must lose access immediately, not only on next login.
            if ((int) ($admin->status ?? 1) !== 1) {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.auth.login');
            }
            return $next($request);
        }
        return redirect()->route('admin.auth.login');
    }
}
