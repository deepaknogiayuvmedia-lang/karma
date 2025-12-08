<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleManagorAuth
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
        if (Auth::guard('sale_manager')->check()) {

            return $next($request);
        }
          return response()->json([
            'auth-001' => translate('Your existing session token does not authorize you any more')
        ], 401);
        return redirect()->route('sale.auth.login');
    }
}



