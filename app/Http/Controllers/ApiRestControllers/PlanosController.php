<?php

namespace App\Http\Controllers\ApiRestControllers;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PlanosController extends Controller
{
    public function __construct(){}

    public function cargarPlanos(Request $request): JsonResponse {

        $imagenes = $request->file('PlanIMG');

        if ( isset( $imagenes ) && isset($request->PropertyId) ) {

            if( !empty( $imagenes ) )
            {
                // $validator = Validator::make($request->all(), [
                //     'PlanIMG.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:4080'
                // ]);

                // if ($validator->fails())
                // {
                //     return response()->json(['mensaje' => 'Formato no soportado'], 400);
                // }

                //verificar si existe la propiedad primero, para despues guardar los datos.
                if(!Property::where('properties_id', $request->PropertyId)->exists())
                {
                    return response()->json(['mensaje' => 'Propiedad no encontrada'], 404);
                }

                $rutaImagenes = array_map(function($imagen) {
                    return $imagen->store('imagenes_planos', 'public');
                }, $imagenes);

                //luego de haber guardado a nivel del proyecto las imagenes... vamos a guardar su ruta.
                foreach($rutaImagenes as $ruta)
                {
                    $plano = new Plan();
                    $plano->plans_route = $ruta;
                    $plano->plans_propertiesId = $request->PropertyId;
                    $plano->save();
                }

                return response()->json(['mensaje' => "Guardado correctamente"], 200);
            }
        }

        return response()->json(['mensaje' => 'Parametro indefinido o vacio'], 500);
    }
}
?>
