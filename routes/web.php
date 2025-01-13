<?php
use App\Http\Controllers\GestionPropiedadController;
use App\Http\Controllers\InicioSesionController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

/**
 * =============================================================================
 * Inicio Sesion.
 * =============================================================================
 */
Route::get('/', [InicioSesionController::class, 'index']);

/**
 * =============================================================================
 * Gestion Propiedades.
 * =============================================================================
 */
Route::controller(GestionPropiedadController::class)->group(function () {
    Route::get('/propiedades', 'propiedad');
    Route::post('/propiedades/registrar', 'registrarPropiedad');
    Route::post('/propiedades/actualizar', 'actualizarPropiedad');
})->middleware('propiedadMidlw');


