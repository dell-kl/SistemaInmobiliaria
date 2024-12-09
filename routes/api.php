<?php
/**
 * Definicion de todas las rutas que seran consumidas tanto para la parte movil
 * como para la parte web.
 */

use App\Http\Controllers\ApiRestControllers\ImagenesController;
use App\Http\Controllers\ApiRestControllers\PropiedadesController;
use App\Http\Controllers\ApiRestControllers\SesionController;
use App\Http\Controllers\ApiRestControllers\UbicacionesController;
use Illuminate\Support\Facades\Route;

/**
 * ============================================================================
 * Inicio Sesion
 * ===========================================================================
 */
Route::post('/sesion/inicio', [SesionController::class, 'inicioSesion']);


/**
 * ============================================================================
 * Propiedades
 * ===========================================================================
 */

Route::get('/propiedades/listar', [PropiedadesController::class, 'index']);
Route::post('/propiedades/registrar', [PropiedadesController::class, 'registrar']);


/**
 * ============================================================================
 * Cantones y Parroquias
 * ===========================================================================
 */
Route::get('/ubicacion/cantones', [UbicacionesController::class, 'obtenerCantones']);
Route::get('/ubicacion/parroquias', [UbicacionesController::class, 'obtenerParroquias']);
Route::get('/ubicacion/listado', [UbicacionesController::class, 'obtenerUbicacionGeneral']);


/**
 * ============================================================================
 * Imagenes
 * ===========================================================================
 */
Route::post('/imagenes/cargar', [ImagenesController::class, 'cargarImagen']);
