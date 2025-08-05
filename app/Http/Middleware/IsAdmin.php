<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Usuario;
use App\Models\Rol;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = $request->user();
        
        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no autenticado'
            ], 401);
        }

        if (!$usuario->rol || !in_array($usuario->rol->nombre_rol, ['Administrador', 'Super Administrador'])) {
            return response()->json([
                'message' => 'No tienes permisos de administrador'
            ], 403);
        }

        return $next($request);
    }
}
