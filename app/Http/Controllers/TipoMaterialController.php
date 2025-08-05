<?php

namespace App\Http\Controllers;

use App\Models\TipoMaterial;
use Illuminate\Http\Request;
use App\Http\Middleware\IsUserAuth;

class TipoMaterialController extends Controller
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
            $tiposMaterial = TipoMaterial::all();
            return response()->json($tiposMaterial);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los tipos de material',
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
                'tipo_elemento' => 'required|string|max:100',
                'estado' => 'required|boolean',
            ]);
            
            // Preparar los datos del tipo de material
            $datos = $request->all();
            
            // Asignar fechas si no están presentes
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
            // Crear el tipo de material
            $tipoMaterial = TipoMaterial::create($datos);
            
            // Devolver mensaje de éxito junto con los datos del tipo de material
            return response()->json([
                'message' => 'Tipo de material creado exitosamente',
                'tipo_material' => $tipoMaterial
            ], 201);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al crear el tipo de material',
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
            $tipoMaterial = TipoMaterial::with('materiales')->findOrFail($id);
            return response()->json($tipoMaterial);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Tipo de material no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoMaterial $tipoMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Buscar el tipo de material por ID
            $tipoMaterial = TipoMaterial::findOrFail($id);
            
            // Validar los datos de entrada
            $request->validate([
                'tipo_elemento' => 'required|string|max:100',
                'estado' => 'required|boolean',
            ]);
            
            // Preparar los datos del tipo de material
            $datos = $request->all();
            
            // Actualizar la fecha de modificación
            $datos['fecha_modificacion'] = now();
            
            // Actualizar el tipo de material
            $tipoMaterial->update($datos);
            
            // Devolver mensaje de éxito junto con los datos actualizados
            return response()->json([
                'message' => 'Tipo de material actualizado exitosamente',
                'tipo_material' => $tipoMaterial
            ]);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al actualizar el tipo de material',
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
            // Buscar el tipo de material por ID
            $tipoMaterial = TipoMaterial::findOrFail($id);
            
            // Guardar el nombre para incluirlo en la respuesta
            $nombreTipoMaterial = $tipoMaterial->tipo_elemento;
            
            // Eliminar el tipo de material
            $tipoMaterial->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Tipo de material eliminado exitosamente',
            ], 200);
            
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar el tipo de material',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
