<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\TipoMaterial;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materiales = Material::with('tipoMaterial')->get();
        return view('materiales.index', compact('materiales'));
    }

    public function create()
    {
        $tiposMaterial = TipoMaterial::all();
        return view('materiales.create', compact('tiposMaterial'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_sena' => 'required|string|max:100',
            'nombre_material' => 'required|string|max:255',
            'descripcion_material' => 'required|string',
            'unidad_medida' => 'required|string|max:100',
            'producto_peresedero' => 'required|boolean',
            'estado' => 'required|boolean',
            'fecha_vencimiento' => 'required|date',
            'imagen' => 'required|string',
            'tipo_material_id' => 'required|exists:tipo_materiales,id_tipo_material',
        ]);
        
        $datos = $request->all();
        
        if (!isset($datos['fecha_creacion'])) {
            $datos['fecha_creacion'] = now();
        }
        
        if (!isset($datos['fecha_modificacion'])) {
            $datos['fecha_modificacion'] = now();
        }
        
        Material::create($datos);
        
        return redirect()->route('materiales.index')->with('success', 'Material creado exitosamente');
    }

    public function show($id)
    {
        try {
            $material = Material::with(['tipoMaterial', 'caracteristicas', 'movimientos'])->findOrFail($id);
            return response()->json($material);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Material no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        $tiposMaterial = TipoMaterial::all();
        return view('materiales.edit', compact('material', 'tiposMaterial'));
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);
        
        $request->validate([
            'codigo_sena' => 'required|string|max:100',
            'nombre_material' => 'required|string|max:255',
            'descripcion_material' => 'required|string',
            'unidad_medida' => 'required|string|max:100',
            'producto_peresedero' => 'required|boolean',
            'estado' => 'required|boolean',
            'fecha_vencimiento' => 'required|date',
            'imagen' => 'required|string',
            'tipo_material_id' => 'required|exists:tipo_materiales,id_tipo_material',
        ]);
        
        $datos = $request->all();
        $datos['fecha_modificacion'] = now();
        
        $material->update($datos);
        
        return redirect()->route('materiales.index')->with('success', 'Material actualizado exitosamente');
    }

    public function destroy($id)
    {
        try {
            $material = Material::findOrFail($id);
            $material->delete();
            
            return response()->json([
                'message' => 'Material eliminado exitosamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el material',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

