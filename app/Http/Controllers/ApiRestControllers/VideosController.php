<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function __construct() {}

    public function cargarVideo(Request $request) : JsonResponse {

        if ( isset($request->route) && isset($request->propertyId) )
        {
            //verificar si la propiedad existe.
            if(!Property::where('properties_id', $request->propertyId)->exists())
            {
                return response()->json(['mensaje' => 'Propiedad no encontrada'], 404);
            }

            //vamos a verificar que las rutas de videos no se encuentren vacios.
            if( empty($request->route) )
            {
                return response()->json(['mensaje' => 'Rutas de videos vacias'], 400);
            }

            //cuando todo este validado y pasabel vamos a guardalos en la base de datos.
            foreach($request->route as $ruta)
            {
                $video = new Video();
                $video->videos_route = $ruta;
                $video->videos_propertiesId = $request->propertyId;
                $video->save();
            }

            return response()->json(['mensaje' => 'Videos cargados correctamente'], 200);
        }

        return response()->json(['mensaje' => "Propiedades vacias o no definidas"], 500);
    }

    public function obtenerCodigos(int $id) : JsonResponse
    {
        $video = Video::where('videos_propertiesId', $id)->first();

        if ( isset($video) )
        {
            $ruta = "https://www.youtube.com/embed/" . $video->videos_route;
            return response()->json(['mensaje' => $ruta], 200);
        }

        return response()->json(['mensaje' => "Video no encontrado"], 500);
    }
}
?>
