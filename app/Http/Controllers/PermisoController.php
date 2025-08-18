<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permisos = \App\Models\Permiso::with(['modulo', 'rol'])->get();
        return view('permisos.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modulos = \App\Models\Modulo::all();
        $roles = \App\Models\Rol::all();
        return view('permisos.create', compact('modulos', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'puede_ver' => 'required|boolean',
            'puede_crear' => 'required|boolean',
            'puede_editar' => 'required|boolean',
            'modulo_id' => 'required|array',
            'modulo_id.*' => 'exists:modulos,id_modulo',
            'rol_id' => 'required|exists:roles,id_rol',
        ]);

        // Crear un permiso para cada módulo seleccionado
        foreach ($validated['modulo_id'] as $moduloId) {
            \App\Models\Permiso::create([
                'nombre' => $validated['nombre'],
                'estado' => $validated['estado'],
                'puede_ver' => $validated['puede_ver'],
                'puede_crear' => $validated['puede_crear'],
                'puede_editar' => $validated['puede_editar'],
                'puede_eliminar' => false, // Asegurarse de incluir todos los campos necesarios
                'modulo_id' => $moduloId,
                'rol_id' => $validated['rol_id'],
            ]);
        }

        return redirect()->route('permisos.index')->with('success', 'Permiso(s) creado(s) exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permiso $permiso)
    {
        return $permiso;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permiso = \App\Models\Permiso::findOrFail($id);
        $modulos = \App\Models\Modulo::all();
        $roles = \App\Models\Rol::all();
        return view('permisos.edit', compact('permiso', 'modulos', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $permiso = \App\Models\Permiso::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required',
            'estado' => 'required|boolean',
            'puede_ver' => 'required|boolean',
            'puede_crear' => 'required|boolean',
            'puede_editar' => 'required|boolean',
            'modulo_id' => 'required|exists:modulos,id_modulo',
            'rol_id' => 'required|exists:roles,id_rol',
        ]);
        $permiso->update($validated);
        return redirect()->route('permisos.index')->with('success', 'Permiso actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permiso $permiso)
    {
        $permiso->delete();
        return response()->json(null, 204);
    }
}
