<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\AlquilerController;

// ---------------------
// AUTENTICACIÓN
// ---------------------

// Página principal: formulario de login
Route::get('/', [AuthController::class, 'mostrarLogin'])->name('login');

// Procesa el formulario de login
Route::post('/verificar-login', [AuthController::class, 'verificarLogin'])->name('verificar.login');

// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ---------------------
// MENÚ Y RECARGA
// ---------------------

// Vista del menú principal después del login
Route::get('/menu', [AuthController::class, 'menuVista'])->name('menu');

// Vista para recargar saldo
Route::get('/recargar', [AuthController::class, 'recargarVista'])->name('recargar');

// Procesar recarga
Route::post('/recargar', [AuthController::class, 'procesarRecarga'])->name('recargar.saldo');



// ---------------------
// PELÍCULAS
// ---------------------

// Ver lista de películas disponibles
Route::get('/peliculas', [PeliculaController::class, 'index'])->name('peliculas.index');

// Alquilar una película
Route::post('/alquilar/{id}', [PeliculaController::class, 'alquilar'])->name('peliculas.alquilar');



// ---------------------
// HISTORIAL DE ALQUILERES
// ---------------------

// Ver historial del cliente
Route::get('/historial', [AlquilerController::class, 'historial'])->name('historial');
