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
//        $http = new Client();
//
//        $client = \Laravel\Passport\Client::where('password_client', 1)->first();
//        $url = $request->root() . '/api/oauth/token';
//        try {
//            $params = [
//                'grant_type' => 'password',
//                'client_id' => $client->id,
//                'client_secret' => $client->secret,
//                'scope' => '',
//                'username' => 'test@admin.com',
//                'password' => 'admin'
//            ];
//            $response = $http->post('POST', $url, ['form_params' => $params]);
//
//            $tokens = json_decode($response->getBody()->getContents(), true);
//            $token = $tokens['access_token'];

            $value = 'Bearer ' . env('AUTH_TOKEN', '');
            $request->headers->set('Authorization', $value);
            $request->headers->set('content-type', 'application/json');
            $request->server->set('HTTP_AUTHORIZATION', $value);
//        } catch (Exception $e) {
//            throw $e;
//        }


        return $next($request);
    }
}
