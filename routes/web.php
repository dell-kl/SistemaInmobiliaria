<?php

use App\Http\Controllers\GestionPropiedadController;
use App\Http\Controllers\InicioSesionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * =============================================================================
 * Inicio Sesión.
 * =============================================================================
 */
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/**
 * =============================================================================
 * Gestión Propiedades.
 * =============================================================================
 */
Route::controller(GestionPropiedadController::class)->group(function () {
    Route::get('/propiedades', 'propiedad');
    Route::post('/propiedades/registrar', 'registrarPropiedad');
})->middleware('propiedadMidlw');

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