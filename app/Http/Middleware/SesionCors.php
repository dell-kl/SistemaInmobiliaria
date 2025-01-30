<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SesionCors
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
            if ( $autenticacion->profile->obtenerRoles()->first()->roles_name === "administrador"
            ||
            $autenticacion->profile->obtenerRoles()->first()->roles_name === "agente_inmobiliaria"
            )
            {
                //vamos a tener que redireccionar nuevamente a la ruta especifica...
                return redirect('/propiedades');
            }
        }

        $response = $next($request);
        return $response;
    }
}
