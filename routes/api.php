<?php
/**
 * Definicion de todas las rutas que seran consumidas tanto para la parte movil
 * como para la parte web.
 */

use App\Http\Controllers\ApiRestControllers\CoordenadasController;
use App\Http\Controllers\ApiRestControllers\ImagenesController;
use App\Http\Controllers\ApiRestControllers\PlanosController;
use App\Http\Controllers\ApiRestControllers\PropiedadesController;
use App\Http\Controllers\ApiRestControllers\SesionController;
use App\Http\Controllers\ApiRestControllers\UbicacionesController;
use App\Http\Controllers\ApiRestControllers\VideosController;
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

Route::get('/propiedades/listar', [PropiedadesController::class, 'index'])->middleware('solicitudes');
Route::post('/propiedades/registrar', [PropiedadesController::class, 'registrar']);
Route::get('/propiedades/ultimo', [PropiedadesController::class, 'ultimoRegistro']);

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


/**
 * ============================================================================
 * Planos
 * ===========================================================================
 */
Route::post('/planos/cargar', [PlanosController::class, 'cargarPlanos']);


/**
 * ===========================================================================
 * Videos
 * ===========================================================================
 */

Route::post('/videos/cargar', [VideosController::class, 'cargarVideo']);
Route::get('/videos/codigos/{id}', [VideosController::class, 'obtenerCodigos']);


/**
 * ============================================================================
 * Coordenadas
 * ===========================================================================
 */
Route::post('/coordenadas/registrar', [CoordenadasController::class, 'registrarCoordenadas']);
Route::get('/coordenadas/propiedad/{id}', [CoordenadasController::class, 'obtenerCoordenadas']);

