<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;


class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            //code...
            $autenticacion = JWTAuth::authenticate(JWTAuth::getToken());

            if ( $autenticacion)
                return $next($request);

            return response()->json(['mensaje' => 'Inautorizado'], 401);
        } catch (Exception $exception) {
            //throw $th;
            return response()->json(['mensaje' => 'Inautorizado'], 401);
        }

    }
}
