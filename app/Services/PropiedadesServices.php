<?php

namespace App\Services;

use App\Models\Property;

class PropiedadesServices {
    public function __construct() {}

    public function registrarPropiedad(Property $property): bool
    {
        //generaremos la creacion de nuestra propiedad.
        $property->save();
        return true;
    }
}

?>
