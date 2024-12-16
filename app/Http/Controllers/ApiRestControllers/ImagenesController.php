<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenesController extends Controller{

    public function __construct(){}

    public function cargarImagen(Request $request): JsonResponse
    {
        $imagenes = $request->file('FileIMG');

        if ( isset( $imagenes ) && isset($request->PropertyId) ) {

            if(!empty( $imagenes ))
            {
                $validator = Validator::make($request->all(), [
                'FileIMG.*' => 'required|image|mimes:jpeg,png,jpg|max:4080'
                ]);

                if ($validator->fails())
                {
                    return response()->json(['mensaje' => "Archivo incompatible"], 400);
                }

                //verificar si existe la propiedad primero, para despues guardar los datos.
                if(!Property::where('properties_id', $request->PropertyId)->exists())
                {
                    return response()->json(['mensaje' => 'Propiedad no encontrada'], 404);
                }

                $rutaImagenes = array_map(function($imagen) {
                    return $imagen->store('imagenes', 'public');
                }, $imagenes);

                //luego de haber guardado a nivel del proyecto las imagenes... vamos a guardar su ruta.
                foreach($rutaImagenes as $ruta)
                {
                    $picture = new Picture();
                    $picture->pictures_route = $ruta;
                    $picture->Pictures_propertiesId = $request->PropertyId;
                    $picture->save();
                }

                return response()->json(['mensaje' => "Guardado correctamente"], 200);
            }
        }
        return response()->json(['mensaje' => 'Parametro indefinido o vacio'], 500);
    }
}

?>
