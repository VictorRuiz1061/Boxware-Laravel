<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermiso
{
    public function handle($request, Closure $next, $modulo, $accion)
    {
        $usuario = Auth::user();

        // Si es superadmin, acceso total
        if (str_replace(' ', '', strtolower($usuario->rol->nombre_rol)) === 'superadministrador') {
            return $next($request);
        }

        $permiso = $usuario->rol->permisos()
            ->whereHas('modulo', fn($q) => $q->where('rutas', $modulo))
            ->first();

        if (!$permiso || !$permiso["puede_{$accion}"]) {
            return response()->json(['message' => 'No tienes permiso'], 403);
        }

        return $next($request);
    }
}