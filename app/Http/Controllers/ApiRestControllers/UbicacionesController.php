<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Models\Canton;
use App\Models\Parroquia;
use Illuminate\Database\Eloquent\Collection;

class UbicacionesController extends Controller {

    public function __construct() {

    }

    public function obtenerParroquias(): Collection {
        return Parroquia::all();
    }

    public function obtenerCantones(): Collection {
        return Canton::all();
    }

    public function obtenerUbicacionGeneral() {
       return Canton::with('obtenerParroquias')->get();
    }
}

?>
