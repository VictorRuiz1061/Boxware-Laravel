<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\TipoMovimientoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TipoMaterialController;
use App\Http\Controllers\TipoSitioController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\SitioController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ElementoController;
use App\Http\Controllers\InventarioController;

// Ruta principal redirige al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación web
Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebAuthController::class, 'login'])->name('login.web');
Route::post('/register', [WebAuthController::class, 'register'])->name('register.web');
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout.web');

// Rutas protegidas
Route::middleware(['web.auth'])->group(function () {
    Route::get('/dashboard', [WebAuthController::class, 'dashboard'])->name('dashboard');
    
    // Municipios
    Route::resource('municipios', MunicipioController::class)->except(['show']);

    // Perfil de usuario
    Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('usuarios.perfil');
    Route::put('/perfil', [UsuarioController::class, 'actualizarPerfil'])->name('usuarios.perfil.actualizar');
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
// Rutas adicionales para trazabilidad de movimientos   
Route::get('movimientos/historial/{materialId}', [MovimientoController::class, 'historialMaterial'])->name('movimientos.historial');
Route::get('movimientos/inventario/{sitioId}', [MovimientoController::class, 'inventarioSitio'])->name('movimientos.inventario');
Route::post('movimientos/verificar-stock', [MovimientoController::class, 'verificarStock'])->name('movimientos.verificar-stock');

// Tipos de Sitio
Route::resource('tipos_sitio', TipoSitioController::class)->except(['show']);
// Categorías de Elemento
Route::resource('categorias_elementos', ElementoController::class)->except(['show']);
// Municipios - Moved to protected routes
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
Route::get('inventario/por-sitio/{sitioId?}', [InventarioController::class, 'inventarioPorSitio'])->name('inventario.por_sitio');
Route::get('inventario/por-material/{materialId?}', [InventarioController::class, 'inventarioPorMaterial'])->name('inventario.por_material');

// Sitios
Route::resource('sitios', SitioController::class)->except(['show']);
// Fichas
Route::resource('fichas', FichaController::class)->except(['show']);
// Programas
Route::resource('programas', ProgramaController::class)->except(['show']);
// Areas
Route::resource('areas', AreaController::class)->except(['show']);
