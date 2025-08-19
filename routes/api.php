<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ElementoController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CentroController;
use app\Http\Middleware\CheckPermiso;

// ── RUTAS PÚBLICAS (Sin autenticación) ────────────────────────────────────────

Route::post('login', [AuthController::class, 'login'])
    ->name('auth.login');

Route::post('register', [AuthController::class, 'register'])
    ->name('auth.register');


// ── TODAS LAS DEMÁS RUTAS REQUIEREN AUTENTICACIÓN ───────────────────────────────────

Route::middleware(['api', IsUserAuth::class])->group(function () {
    // Información del propio usuario
    Route::get('user', [AuthController::class, 'getUser'])
        ->name('auth.user');

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('auth.logout');
    Route::apiResource('categorias-elementos', ElementoController::class);

    Route::apiResource('municipios', App\Http\Controllers\MunicipioController::class);
    Route::apiResource('centros', CentroController::class);
    Route::apiResource('sedes', App\Http\Controllers\SedeController::class);
    Route::apiResource('areas', App\Http\Controllers\AreaController::class);
    Route::apiResource('programas', App\Http\Controllers\ProgramaController::class);
    Route::apiResource('modulos', App\Http\Controllers\ModuloController::class);
    Route::apiResource('tipo-materiales', App\Http\Controllers\TipoMaterialController::class);
    Route::apiResource('materiales', App\Http\Controllers\MaterialController::class);
    // Route::apiResource('caracteristicas', App\Http\Controllers\CaracteristicaController::class);
    Route::apiResource('tipos-sitio', App\Http\Controllers\TipoSitioController::class);
    Route::apiResource('sitios', App\Http\Controllers\SitioController::class);
    Route::apiResource('inventarios', App\Http\Controllers\InventarioController::class);
    Route::apiResource('tipos-movimiento', App\Http\Controllers\TipoMovimientoController::class);
    Route::apiResource('movimientos', App\Http\Controllers\MovimientoController::class);
    Route::apiResource('fichas', App\Http\Controllers\FichaController::class);
    Route::apiResource('permisos', App\Http\Controllers\PermisoController::class);


    Route::middleware(IsAdmin::class)->group(function () {
        Route::post('categorias-elementos', [ElementoController::class, 'store'])
            ->name('categorias-elementos.store');
        Route::get('categorias-elementos/{elemento}', [ElementoController::class, 'show'])
            ->name('categorias-elementos.show');
        Route::put('categorias-elementos/{elemento}', [ElementoController::class, 'update'])
            ->name('categorias-elementos.update');
        Route::delete('categorias-elementos/{elemento}', [ElementoController::class, 'destroy'])
            ->name('categorias-elementos.destroy');
        Route::apiResource('usuarios', UsuarioController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
        Route::apiResource('roles', RolController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    });

    // Rutas protegidas por permisos para todos los módulos principales
    Route::middleware(['auth:sanctum', 'permiso:/usuarios,ver'])->group(function () {
        Route::get('/usuarios', [UsuarioController::class, 'index']);
    });
    Route::middleware(['auth:sanctum', 'permiso:/usuarios,crear'])->group(function () {
        Route::post('/usuarios', [UsuarioController::class, 'store']);
    });
    Route::middleware(['auth:sanctum', 'permiso:/usuarios,editar'])->group(function () {
        Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update']);
    });
    Route::middleware(['auth:sanctum', 'permiso:/usuarios,eliminar'])->group(function () {
        Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy']);
    });

    Route::middleware(['auth:sanctum', 'permiso:/roles,ver'])->group(function () {
        Route::get('/roles', [RolController::class, 'index']);
    });
    Route::middleware(['auth:sanctum', 'permiso:/roles,crear'])->group(function () {
        Route::post('/roles', [RolController::class, 'store']);
    });
    Route::middleware(['auth:sanctum', 'permiso:/roles,editar'])->group(function () {
        Route::put('/roles/{rol}', [RolController::class, 'update']);
    });
    Route::middleware(['auth:sanctum', 'permiso:/roles,eliminar'])->group(function () {
        Route::delete('/roles/{rol}', [RolController::class, 'destroy']);
    });

    Route::middleware(['auth:sanctum', 'permiso:/modulos,ver'])->group(function () {
        Route::get('/modulos', [App\Http\Controllers\ModuloController::class, 'index']);
    });
    Route::middleware(['auth:sanctum', 'permiso:/modulos,crear'])->group(function () {
        Route::post('/modulos', [App\Http\Controllers\ModuloController::class, 'store']);
    });
    Route::middleware(['auth:sanctum', 'permiso:/modulos,editar'])->group(function () {
        Route::put('/modulos/{modulo}', [App\Http\Controllers\ModuloController::class, 'update']);
    });
    Route::middleware(['auth:sanctum', 'permiso:/modulos,eliminar'])->group(function () {
        Route::delete('/modulos/{modulo}', [App\Http\Controllers\ModuloController::class, 'destroy']);
    });

    // Puedes agregar más bloques similares para los demás módulos principales como programas, sedes, materiales, etc.

});
