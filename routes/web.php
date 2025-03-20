<?php

use App\Http\Controllers\GestionPropiedadController;
use App\Http\Controllers\InicioSesionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\GenerateQRController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\NotificacionProcesoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/**
 * =============================================================================
 * Inicio Sesión.
 * =============================================================================
 */

 Route::controller(InicioSesionController::class)->group(function() {
     Route::get('/login',  'index')->middleware('sesion')->name('login');
     Route::post('/auth', 'auth');
     Route::post('/authQR', 'authQR');
     Route::get('/logout', 'logout');
     Route::get('/reset', 'reset');
     Route::post('/resetPost', 'resetPost');


     Route::get('/proceso-reseteo/{token}', 'procesoReset');
     Route::post('/proceso-reseteo-bck', 'procesoResetPost');
});


/**
 * =============================================================================
 * Página de Inicio.
 * =============================================================================
 */



 Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/**
 * =============================================================================
 * Gestión Propiedades.
 * =============================================================================
 */

 Route::controller(GestionPropiedadController::class)->group(function ($request) {
    Route::get('/propiedades', 'propiedad')->middleware('autenticacionWeb');
    Route::post('/propiedades/registrar', 'registrarPropiedad')->middleware('autenticacionWeb');
    Route::post('/propiedades/actualizar', 'actualizarPropiedad')->middleware('autenticacionWeb');
    Route::get('/propiedades/eliminar/{id}', 'eliminarPropiedad')->middleware('autenticacionWeb');
});


/**
 * =============================================================================
 * Gestión de Usuarios (CRUD).
 * =============================================================================
 */
Route::controller(UserController::class)->prefix('usuarios')->name('usuarios.')->group(function () {
    Route::get('/', 'index')->name('index')->middleware('autenticacionWeb');          // Listar usuarios
    Route::get('/crear', 'create')->name('create')->middleware('autenticacionWeb');   // Formulario crear usuario
    Route::post('/', 'store')->name('store')->middleware('autenticacionWeb');         // Guardar nuevo usuario
    Route::get('/{id}', 'show')->name('show')->middleware('autenticacionWeb');        // Mostrar detalles de un usuario
    Route::get('/{id}/editar', 'edit')->name('edit')->middleware('autenticacionWeb'); // Formulario editar usuario
    Route::put('/{id}', 'update')->name('update')->middleware('autenticacionWeb');    // Actualizar usuario
    Route::delete('/{id}', 'destroy')->name('destroy')->middleware('autenticacionWeb'); // Eliminar usuario
});


Route::resource('institutions', InstitutionController::class)->middleware('autenticacionWeb');
Route::resource('profiles', ProfileController::class)->middleware('autenticacionWeb');


Route::resource('roles', RoleController::class)->middleware('autenticacionWeb');



Route::get('/obtener-interes/{institucionId}', [CreditoController::class, 'getInteres'])->name('obtener.interes');
Route::get('/simular-credito/{id}', [CreditoController::class, 'show'])->name('home.simularCredito');

/**
 * Vista de qr
 */
Route::get('/obtener-qr', [GenerateQRController::class, 'vista']);


/**
 * Capturar la parte de las notificaciones para que se pueda comunicar con el usuario.
 */
Route::post('/notificacion', [NotificacionProcesoController::class, 'obtenerDatos']);
