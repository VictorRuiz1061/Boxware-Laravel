<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WebAuthController extends Controller
{
    public function showLoginForm()
    {
        // Si ya está autenticado, redirigir al dashboard
        if (session()->has('usuario_id')) {
            return redirect()->route('dashboard');
        }
        
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Las credenciales proporcionadas son incorrectas.',
                ]);
        }

        // Verificar si el usuario está activo
        if (!$usuario->estado) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Tu cuenta no está activa. Contacta al administrador.',
                ]);
        }

        // Guardar información del usuario en la sesión
        session([
            'usuario_id' => $usuario->id_usuario,
            'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido,
            'usuario_email' => $usuario->email,
            'usuario_rol' => $usuario->rol ? $usuario->rol->nombre_rol : 'Sin rol',
            'usuario_rol_id' => $usuario->rol_id,
        ]);

        // Si marcó "recordarme", extender la sesión
        if ($request->has('remember')) {
            $request->session()->put('remember_me', true);
        }

        return redirect()->route('dashboard')
            ->with('success', '¡Bienvenido, ' . $usuario->nombre . '!');
    }

    public function logout(Request $request)
    {
        // Limpiar la sesión
        $request->session()->flush();
        
        return redirect()->route('login')
            ->with('success', 'Has cerrado sesión correctamente.');
    }

    public function dashboard()
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('usuario_id')) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para acceder al dashboard.');
        }

        $usuario = Usuario::find(session('usuario_id'));
        
        if (!$usuario) {
            session()->flush();
            return redirect()->route('login')
                ->with('error', 'Usuario no encontrado.');
        }

        return view('dashboard', compact('usuario'));
    }
} 