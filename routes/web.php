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
<<<<<<< Updated upstream
Route::resource('tipo_movimiento', App\Http\Controllers\TipoMovimientoController::class)->except(['show']);
// Movimientos
Route::resource('movimientos', App\Http\Controllers\MovimientoController::class)->except(['show']);
=======
Route::resource('tipo_movimiento', TipoMovimientoController::class)->except(['show']);

// Movimientos
Route::resource('movimientos', MovimientoController::class)->except(['show']);
// Rutas adicionales para trazabilidad de movimientos
Route::get('movimientos/historial/{materialId}', [MovimientoController::class, 'historialMaterial'])->name('movimientos.historial');
Route::get('movimientos/inventario/{sitioId}', [MovimientoController::class, 'inventarioSitio'])->name('movimientos.inventario');
Route::post('movimientos/verificar-stock', [MovimientoController::class, 'verificarStock'])->name('movimientos.verificar-stock');

>>>>>>> Stashed changes
// Tipos de Sitio
Route::resource('tipos_sitio', App\Http\Controllers\TipoSitioController::class)->except(['show']);
// Categorías de Elemento
<<<<<<< Updated upstream
Route::resource('categorias_elementos', App\Http\Controllers\ElementoController::class)->except(['show']);
=======
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
// Rutas adicionales para gestión de inventario
Route::get('inventario/show/{id}', [InventarioController::class, 'show'])->name('inventario.show');
Route::get('inventario/por-sitio/{sitioId?}', [InventarioController::class, 'inventarioPorSitio'])->name('inventario.por-sitio');
Route::get('inventario/por-material/{materialId?}', [InventarioController::class, 'inventarioPorMaterial'])->name('inventario.por-material');

// Sitios
Route::resource('sitios', SitioController::class)->except(['show']);
// Fichas
Route::resource('fichas', FichaController::class)->except(['show']);
// Programas
Route::resource('programas', ProgramaController::class)->except(['show']);
// Areas
Route::resource('areas', AreaController::class)->except(['show']);
>>>>>>> Stashed changes
