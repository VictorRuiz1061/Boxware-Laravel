<?php

namespace App\Http\View\Composers;

use App\Models\Modulo;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ModuleComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $user = Auth::user();
        $authorizedModules = collect();
        
        if ($user && $user->rol) {
            try {
                // Primero, obtener todos los módulos para depuración
                $allModules = \DB::table('modulos')->get();
                \Log::info('Todos los módulos en la base de datos:', $allModules->toArray());
                
                // Obtener permisos del usuario
                $permisosUsuario = \DB::table('permisos')
                    ->where('rol_id', $user->rol_id)
                    ->where('puede_ver', 1)
                    ->get();
                
                \Log::info('Permisos del usuario:', [
                    'user_id' => $user->id,
                    'rol' => $user->rol->nombre_rol,
                    'permisos' => $permisosUsuario->toArray()
                ]);
                
                if ($user->rol->nombre_rol === 'Superadministrador') {
                    // Para superadmin, cargar todos los módulos activos
                    $authorizedModules = Modulo::with(['submodulos' => function($query) {
                        $query->where('estado', 1)
                              ->orderBy('fecha_creacion');
                    }])
                    ->where('estado', 1)
                    ->whereNull('modulo_padre_id')
                    ->orderBy('fecha_creacion')
                    ->get();
                } else {
                    // Para otros roles, cargar solo módulos con permiso de ver
                    $modulosConPermiso = $permisosUsuario->pluck('modulo_id')->toArray();
                    
                    // Obtener módulos principales
                    $authorizedModules = Modulo::whereIn('id_modulo', $modulosConPermiso)
                        ->where('estado', 1)
                        ->whereNull('modulo_padre_id')
                        ->orderBy('fecha_creacion')
                        ->get();
                    
                    // Cargar submódulos para cada módulo principal
                    foreach ($authorizedModules as $modulo) {
                        $submodulosIds = $permisosUsuario
                            ->where('modulo_id', '!=', $modulo->id_modulo) // No incluir el módulo principal
                            ->pluck('modulo_id')
                            ->toArray();
                            
                        $modulo->load(['submodulos' => function($query) use ($submodulosIds) {
                            $query->whereIn('id_modulo', $submodulosIds)
                                  ->where('estado', 1)
                                  ->orderBy('fecha_creacion');
                        }]);
                    }
                }
                
                // Depuración detallada
                \Log::info('Módulos cargados para el usuario:', [
                    'user_id' => $user->id,
                    'rol' => $user->rol->nombre_rol,
                    'modulos_con_permiso' => $user->rol->nombre_rol === 'Superadministrador' 
                        ? 'Todos (superadmin)' 
                        : $modulosConPermiso ?? [],
                    'modulos_cargados' => $authorizedModules->map(function($module) {
                        return [
                            'id' => $module->id_modulo,
                            'nombre' => $module->nombre,
                            'ruta' => $module->ruta,
                            'estado' => $module->estado,
                            'modulo_padre_id' => $module->modulo_padre_id,
                            'submodulos_count' => $module->submodulos->count(),
                            'submodulos' => $module->submodulos->map(function($sub) {
                                return [
                                    'id' => $sub->id_modulo,
                                    'nombre' => $sub->nombre,
                                    'ruta' => $sub->ruta,
                                    'estado' => $sub->estado,
                                    'modulo_padre_id' => $sub->modulo_padre_id
                                ];
                            })->toArray()
                        ];
                    })->toArray()
                ]);
                
            } catch (\Exception $e) {
                \Log::error('Error al cargar módulos: ' . $e->getMessage());
                \Log::error($e->getTraceAsString());
                
                // En desarrollo, mostrar el error en pantalla
                if (app()->environment('local')) {
                    dd([
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
            }
        } else {
            \Log::warning('Usuario o rol no definido al cargar módulos', [
                'user' => $user ? $user->id : 'No autenticado',
                'rol' => $user && $user->rol ? $user->rol->nombre_rol : 'No definido'
            ]);
        }
        
        $view->with([
            'authorizedModules' => $authorizedModules,
            'debug_user' => $user ? [
                'id' => $user->id,
                'name' => $user->name,
                'rol' => $user->rol ? $user->rol->nombre_rol : 'Sin rol'
            ] : 'No autenticado'
        ]);
    }

    /**
     * Obtener módulos autorizados para un usuario
     */
    protected function getAuthorizedModules($user)
    {
        return Modulo::whereHas('permisos', function($query) use ($user) {
                $query->where('rol_id', $user->rol_id)
                      ->where('puede_ver', 1);
            })
            ->where('estado', 1)
            ->whereNull('modulo_padre_id')
            ->with(['permisos' => function($query) use ($user) {
                $query->where('rol_id', $user->rol_id);
            }])
            ->orderBy('orden', 'asc')
            ->get();
    }
    
    /**
     * Obtiene los submódulos para un módulo dado
     */
    protected function getSubmodules($module)
    {
        if (auth()->user()->rol->nombre_rol === 'Superadministrador') {
            return Modulo::where('modulo_padre_id', $module->id_modulo)
                ->where('estado', 1)
                ->orderBy('orden')
                ->get();
        }
        
        return Modulo::where('modulo_padre_id', $module->id_modulo)
            ->where('estado', 1)
            ->whereHas('permisos', function($query) {
                $query->where('rol_id', auth()->user()->rol_id)
                      ->where('puede_ver', 1);
            })
            ->orderBy('orden')
            ->get();
    }
}
