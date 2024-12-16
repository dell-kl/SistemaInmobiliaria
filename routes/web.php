<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/propiedades', function() {
    return view('moduloGestionPropiedad.propiedad');
});

Route::get('/usuarios', function () {
    return view('moduloGestionUsuario.usuario');
});