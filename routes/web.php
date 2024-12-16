<?php
use App\Http\Controllers\GestionPropiedadController;
use App\Http\Controllers\InicioSesionController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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
})->middleware('propiedadMidlw');

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/propiedades', function() {
    return view('moduloGestionPropiedad.propiedad');
});

Route::get('/usuarios', function () {
    return view('moduloGestionUsuario.usuario');
});