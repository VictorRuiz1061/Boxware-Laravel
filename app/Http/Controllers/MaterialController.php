<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Middleware\IsUserAuth;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware(IsUserAuth::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $materiales = Material::with('tipoMaterial')->get();
            return response()->json($materiales);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los materiales',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
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
            
            // Preparar los datos del material
            $datos = $request->all();
            
            // Asignar fechas si no están presentes
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
            // Crear el material
            $material = Material::create($datos);
            
            // Cargar la relación de tipo de material
            $material->load('tipoMaterial');
            
            // Devolver mensaje de éxito junto con los datos del material
            return response()->json([
                'message' => 'Material creado exitosamente',
                'material' => $material
            ], 201);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al crear el material',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Buscar el material por ID
            $material = Material::findOrFail($id);
            
            // Validar los datos de entrada
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
            
            // Preparar los datos del material
            $datos = $request->all();
            
            // Actualizar la fecha de modificación
            $datos['fecha_modificacion'] = now();
            
            // Actualizar el material
            $material->update($datos);
            
            // Cargar la relación de tipo de material
            $material->load('tipoMaterial');
            
            // Devolver mensaje de éxito junto con los datos actualizados
            return response()->json([
                'message' => 'Material actualizado exitosamente',
                'material' => $material
            ]);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al actualizar el material',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Buscar el material por ID
            $material = Material::findOrFail($id);
            
            // Guardar el nombre para incluirlo en la respuesta
            $nombreMaterial = $material->nombre_material;
            
            // Eliminar el material
            $material->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Material eliminado exitosamente',
            ], 200);

            
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar el material',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
