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

// Resource routes with permission middleware
Route::middleware(['web.auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [WebAuthController::class, 'dashboard'])->name('dashboard');

    // Helper function to create protected resource routes
    $protectedResource = function ($name, $controller) {
        Route::middleware(["check.permiso:{$name},view"])->group(function () use ($name, $controller) {
            Route::get($name, [$controller, 'index'])->name("{$name}.index");
        });
        Route::middleware(["check.permiso:{$name},create"])->group(function () use ($name, $controller) {
            Route::get("{$name}/create", [$controller, 'create'])->name("{$name}.create");
            Route::post($name, [$controller, 'store'])->name("{$name}.store");
        });
        Route::middleware(["check.permiso:{$name},update"])->group(function () use ($name, $controller) {
            Route::get("{$name}/{{$name}}/edit", [$controller, 'edit'])->name("{$name}.edit");
            Route::put("{$name}/{{$name}}", [$controller, 'update'])->name("{$name}.update");
        });
        Route::middleware(["check.permiso:{$name},delete"])->group(function () use ($name, $controller) {
            Route::delete("{$name}/{{$name}}", [$controller, 'destroy'])->name("{$name}.destroy");
        });
    };

    // Apply protected routes
    $protectedResource('usuarios', UsuarioController::class);
    $protectedResource('roles', RolController::class);
    $protectedResource('permisos', PermisoController::class);
    $protectedResource('modulos', ModuloController::class);
    $protectedResource('tipo_movimiento', 'App\Http\Controllers\TipoMovimientoController');
    $protectedResource('movimientos', 'App\Http\Controllers\MovimientoController');
    $protectedResource('tipos_sitio', 'App\Http\Controllers\TipoSitioController');
    $protectedResource('categorias_elementos', 'App\Http\Controllers\ElementoController');
});
