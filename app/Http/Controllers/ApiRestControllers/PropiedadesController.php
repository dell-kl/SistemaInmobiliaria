<?php

namespace App\Http\Controllers\ApiRestControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PropiedadesServices;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class PropiedadesController extends Controller
{
    private $propiedadService;

    public function __construct(PropiedadesServices $propiedadesServices){
        $this->propiedadService = $propiedadesServices;
    }

    public function index(Request $request): JsonResponse
    {
        $query = Property::with('images', 'videos', 'planos', 'obtenerTipoPropiedad', 'obtenerUbicacion', 'obtenerCoordenadas');

        if ($request->filled('tipo')) {
            $query->where('Properties_typePropertieId', $request->input('tipo'));
        }

        if ($request->filled('habitaciones')) {
            $query->where('properties_rooms', $request->input('habitaciones'));
        }

        if ($request->filled('precio_min')) {
            $query->where('properties_price', '>=', $request->input('precio_min'));
        }

        if ($request->filled('precio_max')) {
            $query->where('properties_price', '<=', $request->input('precio_max'));
        }

        $listadoPropiedades = $query->get();

        return response()->json($listadoPropiedades, 200);
    }

    public function registrar(Request $request): JsonResponse
    {
        $propiedad = new Property();
        $propiedad->properties_rooms = $request->properties_rooms;
        $propiedad->properties_bathrooms = $request->properties_bathrooms;
        $propiedad->properties_parking = $request->properties_parking;
        $propiedad->properties_price = $request->properties_price;
        $propiedad->properties_availability = $request->properties_availability;
        $propiedad->properties_height = $request->properties_height;
        $propiedad->properties_area = $request->properties_area;
        $propiedad->properties_description = $request->properties_description;
        $propiedad->properties_state = $request->properties_state;
        $propiedad->properties_address = $request->properties_address;
        $propiedad->Properties_typePropertieId = $request->Properties_typePropertieId;
        $propiedad->Properties_parroquiasId = $request->Properties_parroquiasId;

        $respuesta = $this->propiedadService->registrarPropiedad($propiedad);

        if ($respuesta) {
            return response()->json(['mensaje' => 'Propiedad registrada correctamente'], 200);
        }

        return response()->json(['mensaje' => 'Error al registrar la propiedad'], 500);
    }

    public function ultimoRegistro() : JsonResponse
    {
        $propiedad = Property::all()->last();
        return response()->json(['mensaje' => $propiedad], 200);
    }

    public function actualizar(Request $request) : JsonResponse
    {
        try {
            $respuesta = Property::updateOrCreate(['properties_id' => $request->properties_id], [
                'properties_rooms' => $request->properties_rooms,
                'properties_bathrooms' => $request->properties_bathrooms,
                'properties_parking' => $request->properties_parking,
                'properties_price' => $request->properties_price,
                'properties_availability' => $request->properties_availability,
                'properties_height' => $request->properties_height,
                'properties_area' => $request->properties_area,
                'properties_description' => $request->properties_description,
                'properties_state' => $request->properties_state,
                'properties_address' => $request->properties_address,
                'Properties_typePropertieId' => $request->Properties_typePropertieId,
                'Properties_parroquiasId' => $request->Properties_parroquiasId
            ]);

            return response()->json(['mensaje' => 'Propiedad actualizada correctamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'Propiedad no actualizada'], 500);
        }
    }

    public function eliminar(Request $request) : JsonResponse
    {
        try {
            $propiedad = Property::where('properties_id', $request->propiedadId)->first();
            $propiedad->delete();
            return response()->json(['mensaje' => 'Propiedad eliminada correctamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'Error al eliminar la propiedad'], 500);
        }
    }

    public function listarPerfil(Request $request)
    {
        $identificador = JWTAuth::parseToken()->getPayload()->get('id');
        $listadoPropiedades = Property::with('images', 'videos', 'planos', 'obtenerTipoPropiedad', 'obtenerUbicacion', 'obtenerCoordenadas', 'responsible')->get();
        dd($listadoPropiedades->where('Responsibles_usersId', $identificador));

        return response()->json($listadoPropiedades, 200);
    }
}