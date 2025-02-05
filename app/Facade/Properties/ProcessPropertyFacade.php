<?php

namespace App\Facade\Properties;

use App\Services\PropiedadesServices;

class ProcessPropertyFacade
{
    private $_propiedadServices;

    private $payload = [
        "properties_id" => "",
        "properties_rooms" => "",
        "properties_bathrooms" => "",
        "properties_parking" => "",
        "properties_price" => "",
        "properties_availability" => "",
        "properties_height" => "",
        "properties_area" => "",
        "properties_description" => "",
        "properties_state" => "",
        "properties_address" => "",
        "Properties_typePropertieId" => "",
        "Properties_parroquiasId" => "",
        "token" => ""
    ];

    public function __construct(
        PropiedadesServices $propiedadesServices
    )
    {
        $this->_propiedadServices = $propiedadesServices;
    }

    public function registrarPropiedad($datos)
    {
        if ($datos["tipoProyecto"] != 1) $datos["numeroEstacionamiento"] = 0;

        //aqui vamos a formatear la parte de nuestro payload o contenido que se lo vamos a tener que pasar a nuestro services.
        $this->payload["properties_rooms"] = $datos["tipoProyecto"] == 3 ? 0 : $datos["numeroHabitaciones"];
        $this->payload["properties_bathrooms"] = $datos["tipoProyecto"] == 3 ? 0 : $datos["numeroBanios"];
        $this->payload["properties_parking"] = $datos["tipoProyecto"] == 3 ? 0 : $datos["numeroEstacionamiento"];
        $this->payload["properties_price"] = $datos["PrecioProyecto"];
        $this->payload["properties_availability"] = $datos["EstadoProyecto"];
        $this->payload["properties_height"] = $datos["tipoProyecto"] != 3 ? $datos["AltoProyecto"] : $datos["ProfundidadProyecto"];
        $this->payload["properties_area"] = $datos["AreaProyecto"];
        $this->payload["properties_description"] = $datos["DescripcionProyecto"];
        $this->payload["properties_state"] = 1;
        $this->payload["properties_address"] = $datos["DireccionProyecto"];
        $this->payload["Properties_typePropertieId"] = $datos["tipoProyecto"];
        $this->payload["Properties_parroquiasId"] = $datos["ParroquiaProyecto"];
        $this->payload["token"] = ""; // Asigna el token correspondiente

        return $this->_propiedadServices->registrarPropiedad($this->payload);
    }

    public function editarPropiedad($datos)
    {
        if ($datos["tipoProyecto"] != 1) $datos["numeroEstacionamiento"] = 0;

        $this->payload["properties_id"] = $datos["propiedadId"];
        $this->payload["properties_rooms"] = $datos["tipoProyecto"] == 3 ? 0 : $datos["numeroHabitaciones"];
        $this->payload["properties_bathrooms"] = $datos["tipoProyecto"] == 3 ? 0 : $datos["numeroBanios"];
        $this->payload["properties_parking"] = $datos["tipoProyecto"] == 3 ? 0 : $datos["numeroEstacionamiento"];
        $this->payload["properties_price"] = $datos["PrecioProyecto"];
        $this->payload["properties_availability"] = $datos["EstadoProyecto"];
        $this->payload["properties_height"] = $datos["tipoProyecto"] != 3 ? $datos["AltoProyecto"] : $datos["ProfundidadProyecto"];
        $this->payload["properties_area"] = $datos["AreaProyecto"];
        $this->payload["properties_description"] = $datos["DescripcionProyecto"];
        $this->payload["properties_state"] = 1;
        $this->payload["properties_address"] = $datos["DireccionProyecto"];
        $this->payload["Properties_typePropertieId"] = $datos["tipoProyecto"];
        $this->payload["Properties_parroquiasId"] = $datos["ParroquiaProyecto"];
        $this->payload["token"] = ""; // Asigna el token correspondiente

        return $this->_propiedadServices->editarPropiedad($this->payload);
    }

    public function eliminarPropiedad($id)
    {
        return $this->_propiedadServices->eliminarPropiedad($id);
    }
}
?>
