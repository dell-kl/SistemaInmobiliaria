<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Models\Coordinate;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoordenadasController extends Controller
{
    public function __construct(){}

    public function registrarCoordenadas(Request $request): JsonResponse {

        if ( isset($request->coodenadas) && isset($request->propertyId) ) {

            //realizar una verificacion de si existe la propiedad.
            if(!Property::where('properties_id', $request->propertyId)->exists())
            {
                return response()->json(['mensaje' => 'Propiedad no encontrada'], 404);
            }

            $coordenadas = new Coordinate();
            $coordenadas->coordinates_route = $request->coodenadas;
            $coordenadas->coordinates_propertiesId = $request->propertyId;
            $coordenadas->save();

            return response()->json(['mensaje' => 'Coordenadas cargadas correctamente'], 200);
        }

        return response()->json(['mensaje' => "Campos no definidas o vacias"], 500);
    }

    public function obtenerCoordenadas(int $id): JsonResponse
    {
        if ( isset($id) ) {
            //vamos a verifiacr si existe la propiedad.
            if(!Property::where('properties_id', $id)->exists())
            {
                return response()->json(['mensaje' => 'Coordenadas no encontrada'], 404);
            }

            $coordenadas = Coordinate::where('coordinates_propertiesId', $id)->first();

            return response()->json(['mensaje' => $coordenadas->coordinates_route], 200);
        }

        return response()->json(['mensaje' => "Campos no definidas o vacias"], 500);
    }

    public function actualizar(Request $request)
    {
        try {
            //code...

            $propiedad = Property::where('properties_id', $request->propertyId)->first();

            $coordenada = $propiedad->obtenerCoordenadas()->first();

            Coordinate::updateOrCreate(['coordinates_id' => $coordenada->coordinates_id],
             ['coordinates_route' => $request->coodenadas]);

            return response()->json(['mensaje' => 'coordenadas actualizada'], 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => 'coordenadas no actualizada'], 500);
        }
    }
}

?>
