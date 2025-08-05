<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ModuloController;

// Ruta principal redirige al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación web
Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebAuthController::class, 'login'])->name('login.web');
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout.web');

// Rutas protegidas
Route::middleware(['web.auth'])->group(function () {
    Route::get('/dashboard', [WebAuthController::class, 'dashboard'])->name('dashboard');
});

// Usuarios
Route::resource('usuarios', UsuarioController::class)->except(['show']);
// Roles
Route::resource('roles', RolController::class)->except(['show']);
// Permisos
Route::resource('permisos', PermisoController::class)->except(['show']);
// Módulos
Route::resource('modulos', ModuloController::class)->except(['show']);
// Tipos de Movimiento
Route::resource('tipo_movimiento', App\Http\Controllers\TipoMovimientoController::class)->except(['show']);
// Movimientos
Route::resource('movimientos', App\Http\Controllers\MovimientoController::class)->except(['show']);
// Tipos de Sitio
Route::resource('tipos_sitio', App\Http\Controllers\TipoSitioController::class)->except(['show']);
// Categorías de Elemento
Route::resource('categorias_elementos', App\Http\Controllers\ElementoController::class)->except(['show']);
