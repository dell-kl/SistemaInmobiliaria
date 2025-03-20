<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Mail\NotificacionCorreo;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificacionesController extends Controller
{
    public function __construct() {}

    public function enviarNotificacion(Request $request)
    {
        try {
            $notificacion = new NotificacionCorreo(
                "",
                "notificacion",
                $request->usuario_nombre,
                $request->usuario_propiedad,
                $request->usuario_direccion
            );
            Mail::to($request->usuario_email)->send($notificacion);
            //code...
            return response()->json(['mensaje' => 'Se ha enviado correctamente la notificacion'], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => $th->getMessage()], 500);
        }
    }

    public function enviarCita(Request $request)
    {
        try {
            //code...
            $notifficacion = new NotificacionCorreo(
                "",
                "cita",
                $request->cita_cliente,
                $request->cita_propiedad,
                "",
                $request->cita_fecha,
                $request->cita_nota,
                $request->cita_comentario
            );
            Mail::to($request->cita_email)->send($notifficacion);
            return response()->json(['mensaje' => 'Se ha enviado correctamente la notificacion'], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => $th->getMessage()], 500);
        }
    }
}
?>
