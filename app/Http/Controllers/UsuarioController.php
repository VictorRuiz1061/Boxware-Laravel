<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        ]);
        $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        \App\Models\Usuario::create($validated);
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
        $usuario = \App\Models\Usuario::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'edad' => 'required|integer|min:0',
            'cedula' => 'required',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id_usuario . ',id_usuario',
            'telefono' => 'required',
            'rol_id' => 'required|exists:roles,id_rol',
            'estado' => 'required|boolean',
        ]);
        if ($request->filled('password')) {
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
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