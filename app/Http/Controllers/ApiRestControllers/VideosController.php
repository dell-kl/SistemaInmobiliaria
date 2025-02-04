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

    public function actualizar(Request $request)
    {
        try {

            /**
             * Algoritmo...
             */

            $listadoCodigos = $request->route;

            //sacaremos los codigos almacenados en nuestra base de datos.
            $videosPropiedad = Video::where('videos_propertiesId', $request->propertyId)->get();
            $codigosDB = $videosPropiedad->select("videos_route")->toArray();

            //tenemos que realizar una comprobacion de cual codigos son nuevos para poder almacenarlos.
            $codigoNuevo =array_filter($listadoCodigos, function($value) use ($codigosDB) {
                if (!in_array(['videos_route' => $value], $codigosDB))
                {
                    return $value;
                }
            });

            if ( !empty($codigoNuevo) )
            {
                //tenemos que registrar el o los nuevos videos.
                foreach($codigoNuevo as $codigo )
                {
                    $video = new Video();
                    $video->videos_route = $codigo;
                    $video->videos_propertiesId = $request->propertyId;
                    $video->save();
                }
            }


            //buscar por codigos que son reemplados y tenemos que eliminarlos.
            $codigosAEliminar = array_filter($codigosDB, function($value) use ($listadoCodigos) {

                $codigo = $value["videos_route"];

                if ( !in_array($codigo, $listadoCodigos) )
                {
                    return $value["videos_route"];
                }

            });

            if ( !empty($codigosAEliminar) )
            {
                $videosFiltradosAEliminar = $videosPropiedad->filter(function($video) use ($codigosAEliminar) {

                    $codigo = $video->videos_route;

                    if ( in_array(['videos_route' => $codigo], $codigosAEliminar) )
                    {
                        return $video;
                    }

                });

                foreach($videosFiltradosAEliminar as $video)
                    Video::where('videos_id', $video->videos_id)->delete();
            }

            return response()->json(['mensaje' => 'Videos actualizados correctamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage()], 500);
        }
    }
}
?>
