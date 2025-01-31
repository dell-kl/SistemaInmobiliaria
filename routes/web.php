<?php

use App\Http\Controllers\GestionPropiedadController;
use App\Http\Controllers\InicioSesionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstitutionController;
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
     Route::get('/logout', 'logout');
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
    Route::get('/', 'index')->name('index');          // Listar usuarios
    Route::get('/crear', 'create')->name('create');   // Formulario crear usuario
    Route::post('/', 'store')->name('store');         // Guardar nuevo usuario
    Route::get('/{id}', 'show')->name('show');        // Mostrar detalles de un usuario
    Route::get('/{id}/editar', 'edit')->name('edit'); // Formulario editar usuario
    Route::put('/{id}', 'update')->name('update');    // Actualizar usuario
    Route::delete('/{id}', 'destroy')->name('destroy'); // Eliminar usuario
});


Route::resource('institutions', InstitutionController::class);
Route::resource('profiles', ProfileController::class);

Route::resource('roles', RoleController::class);

Route::get('/obtener-interes/{institucionId}', [CreditoController::class, 'getInteres'])->name('obtener.interes');
Route::get('/simular-credito/{id}', [CreditoController::class, 'show'])->name('home.simularCredito');