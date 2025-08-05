<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Usuario;

class IsUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if (!$token) {
            $token = $request->header('Authorization');
            if ($token && str_starts_with($token, 'Bearer ')) {
                $token = substr($token, 7);
            }
        }
        
        if (!$token) {
            return response()->json([
                'message' => 'Token no proporcionado'
            ], 401);
        }
        
        $usuario = Usuario::where('api_token', $token)->first();
        
        if (!$usuario) {
            return response()->json([
                'message' => 'Token inválido o expirado'
            ], 401);
        }

        // Adjuntar el usuario a la solicitud para usarlo posteriormente
        $request->setUserResolver(function () use ($usuario) {
            return $usuario;
        });
        
        return $next($request);
    }
}
