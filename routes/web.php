<?php

use App\Http\Controllers\GestionPropiedadController;
use App\Http\Controllers\InicioSesionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


/**
 * =============================================================================
 * Inicio Sesion.
 * =============================================================================
 */

Route::controller(InicioSesionController::class)->group(function() {
    Route::get('/',  'index')->middleware('sesion');
    Route::post('/auth', 'auth');
    Route::get('/logout', 'logout');
});

/**
 * =============================================================================
 * Gestion Propiedades.
 * =============================================================================
 */

 Route::controller(GestionPropiedadController::class)->group(function ($request) {
    Route::get('/propiedades', 'propiedad')->middleware('autenticacionWeb');
    Route::post('/propiedades/registrar', 'registrarPropiedad')->middleware('autenticacionWeb');
    Route::post('/propiedades/actualizar', 'actualizarPropiedad')->middleware('autenticacionWeb');
    Route::get('/propiedades/eliminar/{id}', 'eliminarPropiedad')->middleware('autenticacionWeb');
});


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/propiedades', function() {
    return view('moduloGestionPropiedad.propiedad');
});

Route::get('/usuarios', function () {
    return view('moduloGestionUsuario.usuario');
});
