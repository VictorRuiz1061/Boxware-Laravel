<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermiso
{
    public function handle($request, Closure $next, $modulo, $accion)
    {
        $usuario = Auth::user();

        // Si no hay usuario autenticado, redirigir al login
        if (!$usuario) {
            return redirect()->route('login');
        }

        // Si es superadmin, acceso total
        if ($usuario->rol && str_replace(' ', '', strtolower($usuario->rol->nombre_rol)) === 'superadministrador') {
            return $next($request);
        }

        // Verificar si el usuario tiene un rol y permisos
        if (!$usuario->rol) {
            return redirect()->route('login')->with('error', 'No tienes un rol asignado');
        }

        $permiso = $usuario->rol->permisos()
            ->whereHas('modulo', fn($q) => $q->where('rutas', $modulo))
            ->first();

        if (!$permiso || !$permiso["puede_{$accion}"]) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'No tienes permiso para realizar esta acción'], 403);
            }
            return back()->with('error', 'No tienes permiso para realizar esta acción');
        }

        return $next($request);
    }
}
