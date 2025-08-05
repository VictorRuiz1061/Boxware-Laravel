<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TipoMovimientoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\TipoSitioController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TipoMaterialController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\SitioController;
use App\Http\Controllers\ElementoController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\ProgramaController;

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
Route::resource('tipo_movimiento', TipoMovimientoController::class)->except(['show']);
// Movimientos
Route::resource('movimientos', MovimientoController::class)->except(['show']);
// Tipos de Sitio
Route::resource('tipos_sitio', TipoSitioController::class)->except(['show']);
// Categorías de Elemento
Route::resource('categorias_elementos', ElementoController::class)->except(['show']);
// Municipios
Route::resource('municipio', MunicipioController::class)->except(['show']);
// Centros
Route::resource('centro', CentroController::class)->except(['show']);
// Sedes
Route::resource('sede', SedeController::class)->except(['show']);
// Materiales
Route::resource('materiales', MaterialController::class)->except(['show']);
// Tipos de Material
Route::resource('tipo_material', TipoMaterialController::class)->except(['show']);
// Inventario
Route::resource('inventario', InventarioController::class)->except(['show']);
// Sitios
Route::resource('sitios', SitioController::class)->except(['show']);
// Fichas
Route::resource('fichas', FichaController::class)->except(['show']);
// Programas
Route::resource('programas', ProgramaController::class)->except(['show']);
// Areas
Route::resource('areas', AreaController::class)->except(['show']);
