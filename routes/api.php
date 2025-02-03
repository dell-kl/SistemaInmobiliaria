<?php
/**
 * Definicion de todas las rutas que seran consumidas tanto para la parte movil
 * como para la parte web.
 */

use App\Http\Controllers\ApiRestControllers\AutorizacionesController;
use App\Http\Controllers\ApiRestControllers\CoordenadasController;
use App\Http\Controllers\ApiRestControllers\ImagenesController;
use App\Http\Controllers\ApiRestControllers\PermisosController;
use App\Http\Controllers\ApiRestControllers\PlanosController;
use App\Http\Controllers\ApiRestControllers\PropiedadesController;
use App\Http\Controllers\ApiRestControllers\ResponsibleController;
use App\Http\Controllers\ApiRestControllers\RolesController;
use App\Http\Controllers\ApiRestControllers\SesionController;
use App\Http\Controllers\ApiRestControllers\UbicacionesController;
use App\Http\Controllers\ApiRestControllers\UsuarioController;
use App\Http\Controllers\ApiRestControllers\VideosController;
use Illuminate\Support\Facades\Route;

/**
 * ============================================================================
 * Inicio Sesion
 * ===========================================================================
 */

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/sesion', [SesionController::class, 'inicioSesion']);
    Route::post('/cerrar', [SesionController::class, 'cerrarSesion']);
    Route::post('/reset', [SesionController::class, 'reset']);
});

/**
 * ============================================================================
 * Existencia de usuarios
 * ============================================================================
 */
Route::post('/usuario/verificar', [UsuarioController::class, 'encontrarUsuario']);

/**
 * ============================================================================
 * Propiedades
 * ===========================================================================
 */
Route::get('/propiedades/listar', [PropiedadesController::class, 'index'])->middleware('solicitudes');
Route::post('/propiedades/registrar', [PropiedadesController::class, 'registrar'])->middleware('autenticacion');
Route::get('/propiedades/ultimo', [PropiedadesController::class, 'ultimoRegistro']);
Route::post('/propiedades/actualizar', [PropiedadesController::class, 'actualizar'])->middleware('autenticacion');
Route::delete('/propiedades/eliminar', [PropiedadesController::class, 'eliminar'])->middleware('autenticacion');
Route::post('/propiedades/listar/perfil', [PropiedadesController::class, 'listarPerfil'])->middleware('autenticacion');
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
Route::post('/imagenes/cargar', [ImagenesController::class, 'cargarImagen'])->middleware('autenticacion');


/**
 * ============================================================================
 * Planos
 * ===========================================================================
 */
Route::post('/planos/cargar', [PlanosController::class, 'cargarPlanos'])->middleware('autenticacion');


/**
 * ===========================================================================
 * Videos
 * ===========================================================================
 */

Route::post('/videos/cargar', [VideosController::class, 'cargarVideo'])->middleware('autenticacion');
Route::get('/videos/codigos/{id}', [VideosController::class, 'obtenerCodigos']);
Route::post('/videos/actualizar', [VideosController::class, 'actualizar'])->middleware('autenticacion');


/**
 * ============================================================================
 * Coordenadas
 * ===========================================================================
 */
Route::get('/coordenadas/propiedad/{id}', [CoordenadasController::class, 'obtenerCoordenadas']);
Route::post('/coordenadas/registrar', [CoordenadasController::class, 'registrarCoordenadas'])->middleware('autenticacion');
Route::post('/coordenadas/actualizar', [CoordenadasController::class, 'actualizar'])->middleware('autenticacion');


/**
 * =============================================================================
 * Responsible
 * =============================================================================
 */
Route::post('/responsable/registrar', [ResponsibleController::class, 'registrarResponsable'])->middleware('autenticacion');


/**
 * ============================================================================
 * Roles
 * =============================================================================
 */

Route::get('/roles/listar', [RolesController::class, 'listarRoles']);


/**
 * ============================================================================
 * Permisos
 * =============================================================================
 */
Route::get('/permisos/listar', [PermisosController::class, 'listarPermisos']);



/**
 * ============================================================================
 * Autorzaciones
 * ============================================================================
 */

 Route::get('/autorizaciones/listar', [AutorizacionesController::class, 'listarAutorizaciones']);
