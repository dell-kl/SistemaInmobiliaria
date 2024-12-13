<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InicioSesionController extends Controller
{
    public function __construct() {}

    public function index() {
        return View('moduloSeguridad.login');
    }
}
