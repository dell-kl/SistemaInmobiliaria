<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermisosController extends Controller
{
    public function __construct() {
    }

    //dentro de este apartado nos encargaremos de hacer un listado de todos los permisos que tenemos
    //disponibles hasta el momento.
    //esto de aqui lo mezclaremos con nuestro token jwt que lo creamos para asi poder discriminando
    //que es lo que ve y no ve la persona.
    public function listarPermisos(Request $request) {
       try {
            //code...
            $permisos = Permission::all();
            return response()->json(['mensaje' => $permisos], 200);
       } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'permisos no encontrados'], 500);
       }
    }
}
?>
