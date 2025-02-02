<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UsuarioController extends Controller {

    public function __construct()
    {

    }

    public function encontrarUsuario(Request $request)
    {
        try {
            //code...
            $usuario = User::where('users_email', $request->email)->get();

            if ( $usuario->isEmpty() ) {
                return response()->json(['mensaje' => 'usuario no encontrado'], 500);
            }

            return response()->json(['mensaje' => $usuario->first()], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => 'usuario no encontrado'], 500);
        }
    }
}
?>
