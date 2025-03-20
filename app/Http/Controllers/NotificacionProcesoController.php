<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificacionProcesoController extends Controller
{
    public function __construct(){}

    public function obtenerDatos(Request $request)
    {
        $api = config('app.url_api') . '/api/notificaciones/enviar/contacto';

        $respuesta = Http::post($api, [
            "usuario_email" => $request->email,
            "usuario_nombre" => $request->name,
            "usuario_propiedad" => $request->propiedad,
            "usuario_direccion" => $request->direccion
        ]);

        return redirect('/');
        // ->with('success', 'Se ha enviado correctamente la notificacion');
    }
}
