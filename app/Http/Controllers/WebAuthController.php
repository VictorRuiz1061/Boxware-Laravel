<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class WebAuthController extends Controller
{
    public function showLoginForm()
    {
        // Si ya está autenticado, redirigir al dashboard
        if (session()->has('usuario_id')) {
            return redirect()->route('dashboard');
        }
        
        // Obtener roles para el formulario de registro
        $roles = Rol::where('estado', 1)->get();
        
        return view('login', compact('roles'));
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
            'usuario_imagen' => $usuario->imagen,
        ]);

        // Si marcó "recordarme", extender la sesión
        if ($request->has('remember')) {
            $request->session()->put('remember_me', true);
        }

        return redirect()->route('dashboard')
            ->with('success', '¡Bienvenido, ' . $usuario->nombre . '!');
    }
    
    /**
     * Registra un nuevo usuario en el sistema
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:usuarios',
            'edad' => 'required|integer|min:18',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'telefono' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'cedula.required' => 'La cédula es obligatoria',
            'cedula.unique' => 'Esta cédula ya está registrada',
            'edad.required' => 'La edad es obligatoria',
            'edad.min' => 'Debes tener al menos 18 años',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Ingresa un correo electrónico válido',
            'email.unique' => 'Este correo electrónico ya está registrado',
            'telefono.required' => 'El teléfono es obligatorio',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);
        
        try {
            // Iniciar transacción para asegurar la integridad de los datos
            DB::beginTransaction();
            
            // Crear el nuevo usuario
            $usuario = new Usuario();
            $usuario->nombre = $validated['nombre'];
            $usuario->apellido = $validated['apellido'];
            $usuario->cedula = $validated['cedula'];
            $usuario->edad = $validated['edad'];
            $usuario->email = $validated['email'];
            $usuario->telefono = $validated['telefono'];
            $usuario->rol_id = 1; // Asignar rol 1 por defecto
            $usuario->password = Hash::make($validated['password']);
            $usuario->estado = 1; // Usuario activo por defecto
            $usuario->fecha_registro = now(); // Fecha de registro actual
            $usuario->save();
            
            // Confirmar la transacción
            DB::commit();
            
            // Iniciar sesión automáticamente
            session([
                'usuario_id' => $usuario->id_usuario,
                'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido,
                'usuario_email' => $usuario->email,
                'usuario_rol' => $usuario->rol ? $usuario->rol->nombre_rol : 'Sin rol',
                'usuario_rol_id' => $usuario->rol_id,
                'usuario_imagen' => $usuario->imagen,
            ]);
            
            // Redireccionar al dashboard con mensaje de éxito
            return redirect()->route('dashboard')
                ->with('success', '¡Bienvenido a BoxWare, ' . $usuario->nombre . '! Tu cuenta ha sido creada exitosamente.');
            
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            
            // Redireccionar de vuelta con mensaje de error
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['general' => 'Error al registrar el usuario: ' . $e->getMessage()]);
        }
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