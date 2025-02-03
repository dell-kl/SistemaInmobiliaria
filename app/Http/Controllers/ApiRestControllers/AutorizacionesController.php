<?php

namespace App\Http\Controllers\ApiRestControllers;
use App\Http\Controllers\Controller;
use App\Models\Authorization;

class AutorizacionesController extends Controller
{
    public function __construct() {}

    public function listarAutorizaciones() {
        try {

            $autorizaciones = Authorization::all();
            return response()->json(['mensaje' => $autorizaciones], 200);
       } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'autorizaciones no encontrados'], 500);
       }
    }
}
?>
