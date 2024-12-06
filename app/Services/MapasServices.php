<?php

namespace App\Services;

class MapasServices {
    public function __construct() {
    }

    public function registrarMapa($mapa) : bool {
        $mapa->save();
        return true;
    }
}
?>
