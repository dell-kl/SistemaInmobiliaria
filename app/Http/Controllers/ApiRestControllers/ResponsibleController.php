<?php

namespace App\Http\Controllers\ApiRestControllers;
use App\Http\Controllers\Controller;
use App\Models\Responsible;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ResponsibleController extends Controller
{
    public function __construct() {}

    public function registrarResponsable(Request $request): JsonResponse
    {
        try {

            $responsable = new Responsible();
            $responsable->Responsibles_propertiesId = $request->idPropiedad;
            $responsable->Responsibles_usersId = $request->idUsuario;
            $responsable->save();

            //vamos a asignar a un responsable a una de la propiedad creada.
            return response()->json(['mensaje' => 'Asignacion de propiedad exitosa'], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => 'Asignacion de propiedad fallida, comuniquese con TI para que lo asigne manualmente'], 500);
        }
    }
}
?>
