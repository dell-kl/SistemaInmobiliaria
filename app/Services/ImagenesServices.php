<?php

namespace App\Services;

class ImagenesServices {
    public function __construct() {
    }

    public function registrarImagen($imagen) : bool {
        $imagen->save();
        return true;
    }
}
?>
