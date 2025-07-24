<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function getUser(Request $request)
    {
        $usuario = $request->user();
        
        if ($usuario) {
            // Cargar la relación de rol para incluirla en la respuesta
            $usuario->load('rol');
            return response()->json($usuario);
        }
        
        return response()->json(['message' => 'Usuario no autenticado'], 401);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // Generar un token aleatorio
        $token = Str::random(80);
        
        // Guardar el token en la base de datos
        $usuario->api_token = $token;
        $usuario->save();
        

        return response()->json([
            'mensaje' => 'Inicio de sesión exitoso',
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $usuario = $request->user();
        
        if ($usuario) {
            $usuario->api_token = null;
            $usuario->save();
        }

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
