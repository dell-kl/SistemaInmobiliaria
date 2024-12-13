<?php

namespace App\Http\Controllers\ApiRestControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PropiedadesServices;
use App\Models\Property;
use Illuminate\Http\JsonResponse;

class PropiedadesController extends Controller
{
    private $propiedadService;

    public function __construct(PropiedadesServices $propiedadesServices){
        $this->propiedadService = $propiedadesServices;
    }

    public function index(): JsonResponse{
        $listadoPropiedades = Property::with('images', 'videos', 'planos', 'obtenerTipoPropiedad', 'obtenerUbicacion')->get();
        return response()->json($listadoPropiedades, 200);
    }

    public function registrar(Request $request): JsonResponse {

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
}
?>
