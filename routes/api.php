<?php
/**
 * Definicion de todas las rutas que seran consumidas tanto para la parte movil
 * como para la parte web.
 */

use App\Http\Controllers\ApiRestControllers\PropiedadesController;
use Illuminate\Support\Facades\Route;

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




