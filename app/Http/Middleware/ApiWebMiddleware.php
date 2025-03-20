<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class ApiWebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->add(['Authorization' => $request->cookie('Authorization')] );

        $autenticacion = auth('web')->user();


        if ( $autenticacion !== null )
        {

            $response = $next($request);

            return $response;
        }

        return redirect('/');
    }
}
