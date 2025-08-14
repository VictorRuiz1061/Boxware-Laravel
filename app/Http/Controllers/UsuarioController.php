<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{ 
    public function index()
    {
        $usuarios = \App\Models\Usuario::with('rol')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = \App\Models\Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'edad' => 'required|integer|min:0',
            'cedula' => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
            'telefono' => 'required',
            'rol_id' => 'required|exists:roles,id_rol',
            'estado' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $validated['password'] = Hash::make($validated['password']);
        
        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            // Guardar la imagen en storage/app/public/usuarios
            $rutaImagen = $imagen->storeAs('usuarios', $nombreImagen, 'public');
            $validated['imagen'] = $rutaImagen;
        }
        
        Usuario::create($validated);
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente');
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);
    }

    public function edit($id)
    {
        $usuario = \App\Models\Usuario::findOrFail($id);
        $roles = \App\Models\Rol::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'edad' => 'required|integer|min:0',
            'cedula' => 'required',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id_usuario . ',id_usuario',
            'telefono' => 'required',
            'rol_id' => 'required|exists:roles,id_rol',
            'estado' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }
        
        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($usuario->imagen && Storage::disk('public')->exists($usuario->imagen)) {
                Storage::disk('public')->delete($usuario->imagen);
            }
            
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            // Guardar la nueva imagen
            $rutaImagen = $imagen->storeAs('usuarios', $nombreImagen, 'public');
            $validated['imagen'] = $rutaImagen;
        }
        
        $usuario->update($validated);
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return response()->json([
            'message' => 'Usuario eliminado exitosamente'
        ], 200);
    }
} 