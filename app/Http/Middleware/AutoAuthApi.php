<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Mockery\Exception;

class AutoAuthApi
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
        $value = 'Bearer ' . env('AUTH_TOKEN', '');
        $request->headers->set('Authorization', $value);
        $request->headers->set('content-type', 'application/json');
        $request->server->set('HTTP_AUTHORIZATION', $value);

        return $next($request);
    }
}
