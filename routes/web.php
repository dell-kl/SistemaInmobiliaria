<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('moduloSeguridad/login');
});

Route::get('/propiedades', function() {
    return View('moduloGestionPropiedad/propiedad');
});