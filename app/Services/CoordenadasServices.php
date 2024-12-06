<?php
namespace App\Services;

class CoordenadasServices
{
    public function __construct() {
    }

    public function registrarCoordenadas($coordenadas) : bool {
        $coordenadas->save();
        return true;
    }
}
?>
