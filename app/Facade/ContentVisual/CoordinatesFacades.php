<?php

namespace App\Facade\ContentVisual;

use App\Services\CoordenadasServices;
use App\Services\CoordinatesServices;

class CoordinatesFacades {

    private CoordenadasServices $coordinatesServices;

    public function __construct(CoordenadasServices $coordinatesServices)
    {
        $this->coordinatesServices = $coordinatesServices;
    }

    public function registerCoordinates($propertyId, $coordinates)
    {
        return $this->coordinatesServices->registrarCoordenadas($propertyId, $coordinates);
    }

    public function editCoordinates($propertyId, $coordinates)
    {
        return $this->coordinatesServices->editarCoordenadas($propertyId, $coordinates);
    }
}
?>
