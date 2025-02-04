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
                'FileIMG.*' => 'required|image|mimes:jpeg,png,jpg|max:6080'
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

                /**
                 * Dentro de esta seccion guardamos a nuestra carpeta public todas las imagenes que se van cargando.
                 * Esto para poder utilizado mas adelante por la api.
                 */
                $rutaImagenes = array_map(function($imagen) {
                    return $imagen->store('imagenes', 'public');
                }, $imagenes);

                /**
                 * Vamos a guardar la ruta de las imagenes dentro de nuestra base de datos.. En este caso solo guardamos una ruta
                 * relativa.
                 */
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

    public function eliminarImagen(Request $request)
    {
        try {
            //code...
            $imagen = Picture::where('pictures_id', $request->imagen_id)->get();

            if ( !$imagen->isEmpty() )
            {
                $ruta = '/public/' . $imagen->first()->pictures_route;

                dd($ruta);

                return response()->json(['mensaje' => 'Imagen eliminada correctamente'], 200);
            }

            return response()->json(['mensaje' => 'Imagen no encontrada'], 404);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'Error al eliminar la imagen'], 500);
        }
    }
}

?>
