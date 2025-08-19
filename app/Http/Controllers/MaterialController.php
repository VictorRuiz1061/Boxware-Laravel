<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\TipoMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $categoriasElementos = \App\Models\CategoriaElemento::all();
        return view('materiales.create', compact('tiposMaterial', 'categoriasElementos'));
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
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tipo_material_id' => 'required|exists:tipo_materiales,id_tipo_material',
            'categoria_elemento_id' => 'required|exists:categorias_elementos,id_categoria_elemento',
        ]);
        
        $datos = $request->all();
        
        if (!isset($datos['fecha_creacion'])) {
            $datos['fecha_creacion'] = now();
        }
        
        if (!isset($datos['fecha_modificacion'])) {
            $datos['fecha_modificacion'] = now();
        }
        
        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            // Guardar la imagen en storage/app/public/materiales
            $rutaImagen = $imagen->storeAs('materiales', $nombreImagen, 'public');
            $datos['imagen'] = $rutaImagen;
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
        $categoriasElementos = \App\Models\CategoriaElemento::all();
        return view('materiales.edit', compact('material', 'tiposMaterial', 'categoriasElementos'));
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
            'imagen' => $request->hasFile('imagen') ? 'required|image|mimes:jpeg,png,jpg,gif|max:2048' : 'nullable|string',
            'tipo_material_id' => 'required|exists:tipo_materiales,id_tipo_material',
            'categoria_elemento_id' => 'required|exists:categorias_elementos,id_categoria_elemento',
        ]);
        
        $datos = $request->all();
        $datos['fecha_modificacion'] = now();
        
        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($material->imagen && Storage::disk('public')->exists($material->imagen)) {
                Storage::disk('public')->delete($material->imagen);
            }
            
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            // Guardar la nueva imagen
            $rutaImagen = $imagen->storeAs('materiales', $nombreImagen, 'public');
            $datos['imagen'] = $rutaImagen;
        }
        
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
