<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Tymon\JWTAuth\Facades\JWTAuth;

class ShareUserRole
{
    public function handle($request, Closure $next)
    {
        if (JWTAuth::parseToken()->check()) {
            $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
            View::share('rolUsuario', $rolUsuario);
        }

        return $next($request);
    }
}
//ESTE CREO JOSUE