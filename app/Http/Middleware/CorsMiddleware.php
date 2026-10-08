<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Sends the CORS headers previously hardcoded in bootstrap/app.php.
 *
 * Keeping them in middleware means they are only sent for real HTTP
 * responses (never from artisan/PHPUnit where header() would throw
 * "headers already sent" errors), and OPTIONS preflight requests are
 * answered properly instead of falling through to a 405 route error.
 */
class CorsMiddleware
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
        if ($request->isMethod('OPTIONS')) {
            $response = response('', 204);
        } else {
            $response = $next($request);
        }

        $response->headers->set('Access-Control-Allow-Methods', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');

        return $response;
    }
}
