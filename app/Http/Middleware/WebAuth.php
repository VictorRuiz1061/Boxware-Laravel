<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado en la sesión web
        if (!session()->has('usuario_id')) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Verificar si el usuario existe en la base de datos
        $usuario = \App\Models\Usuario::find(session('usuario_id'));
        
        if (!$usuario) {
            session()->flush();
            return redirect()->route('login')
                ->with('error', 'Usuario no encontrado. Por favor, inicia sesión nuevamente.');
        }

        // Verificar si el usuario está activo
        if (!$usuario->estado) {
            session()->flush();
            return redirect()->route('login')
                ->with('error', 'Tu cuenta no está activa. Contacta al administrador.');
        }

        return $next($request);
    }
} 