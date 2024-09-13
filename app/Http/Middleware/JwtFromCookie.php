<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JwtFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // // Ambil token dari cookie
        //$token = $request->cookie('token');

        // if ($token) {
        //     try {
        //         // Set token agar JWTAuth bisa mengenalinya
        //         JWTAuth::setToken($token);
                
        //         // Autentikasi pengguna
        //         $user = JWTAuth::authenticate();
                
        //         // Set user di context Auth agar bisa digunakan oleh middleware auth:api
        //         Auth::onceUsingId($user->id);
        //     } catch (\Exception $e) {
        //         // Token tidak valid atau ada masalah
        //         return response()->json(['error' => 'Invalid token'], 401);
        //     }
        // }

        if ($token = $request->cookie('token')) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        // return parent::handle($request, $next);

        // return $next($request);
        // try {
        //     $user = JWTAuth::parseToken()->authenticate();
        // } catch (TokenExpiredException $e) {
        //     return response()->json(['error' => 'Token expired'], 401);
        // } catch (JWTException $e) {
        //     return response()->json(['error' => 'Token invalid'], 401);
        // }

        return $next($request);

    }
}
