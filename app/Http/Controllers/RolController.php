<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Http\Requests\RolRequest;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $roles = \App\Models\Rol::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_rol' => 'required',
            'descripcion' => 'nullable',
            'estado' => 'required|boolean',
        ]);
        \App\Models\Rol::create($validated);
        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente');
    }

    public function show($id)
    {
        $rol = Rol::findOrFail($id);
        return response()->json($rol);
    }

    public function edit($id)
    {
        $rol = \App\Models\Rol::findOrFail($id);
        return view('roles.edit', compact('rol'));
    }

    public function update(Request $request, $id)
    {
        $rol = \App\Models\Rol::findOrFail($id);
        $validated = $request->validate([
            'nombre_rol' => 'required',
            'descripcion' => 'nullable',
            'estado' => 'required|boolean',
        ]);
        $rol->update($validated);
        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente');
    }

    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();
        return response()->json([
            'message' => 'Rol eliminado exitosamente'
        ], 200);
    }
} 