<?php

namespace App\Http\Controllers;

use App\Models\TipoMaterial;
use Illuminate\Http\Request;

class TipoMaterialController extends Controller
{
    public function index()
    {
        $tiposMaterial = TipoMaterial::all();
        return view('tipo_material.index', compact('tiposMaterial'));
    }

    public function create()
    {
        return view('tipo_material.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_elemento' => 'required|string|max:100',
            'estado' => 'required|boolean',
        ]);
        
        $datos = $request->all();
        
        if (!isset($datos['fecha_creacion'])) {
            $datos['fecha_creacion'] = now();
        }
        
        if (!isset($datos['fecha_modificacion'])) {
            $datos['fecha_modificacion'] = now();
        }
        
        TipoMaterial::create($datos);
        
        return redirect()->route('tipo_material.index')->with('success', 'Tipo de material creado exitosamente');
    }

    public function show($id)
    {
        try {
            $tipoMaterial = TipoMaterial::with('materiales')->findOrFail($id);
            return response()->json($tipoMaterial);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Tipo de material no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function edit($id)
    {
        $tipoMaterial = TipoMaterial::findOrFail($id);
        return view('tipo_material.edit', compact('tipoMaterial'));
    }

    public function update(Request $request, $id)
    {
        $tipoMaterial = TipoMaterial::findOrFail($id);
        
        $request->validate([
            'tipo_elemento' => 'required|string|max:100',
            'estado' => 'required|boolean',
        ]);
        
        $datos = $request->all();
        $datos['fecha_modificacion'] = now();
        
        $tipoMaterial->update($datos);
        
        return redirect()->route('tipo_material.index')->with('success', 'Tipo de material actualizado exitosamente');
    }

    public function destroy($id)
    {
        try {
            $tipoMaterial = TipoMaterial::findOrFail($id);
            $tipoMaterial->delete();
            
            return response()->json([
                'message' => 'Tipo de material eliminado exitosamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el tipo de material',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}


