<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Services\SesionesServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SesionController extends Controller {

    private SesionesServices $sesionService;

    public function __construct(SesionesServices $sesiones) {
        $this->sesionService = $sesiones;
    }

    public function inicioSesion(Request $request) : JsonResponse {

        if ( isset($request->email) && isset($request->password) ) {
            if ( $this->sesionService->verificarDatos($request->email, $request->password) ) {
                return response()->json(['mensaje' => 'autorizado'], 200);
            }
            return response()->json(['mensaje' => 'invalido'], 403);
        }

        return response()->json(['mensaje' => 'Campos vacios o formato invalido'], 500);
    }

    public function cerrarSesion() {

    }
}
?>
