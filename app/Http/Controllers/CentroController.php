<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use Illuminate\Http\Request;
use App\Http\Middleware\IsUserAuth;

class CentroController extends Controller
{
    public function __construct()
    {
        // Aplicar middleware de autenticación
        $this->middleware(IsUserAuth::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $centros = Centro::all();
            return response()->json($centros);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los centros',
                'error' => $e->getMessage()
            ], 500);
    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'nombre_centro' => 'required|string|max:255',
                'estado' => 'required|boolean',
                'municipio_id' => 'required|exists:municipios,id_municipio',
            ]);
            
            // Preparar los datos del centro
            $datos = $request->all();
            
            // Asignar fechas si no están presentes
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
            // Crear el centro
            $centro = Centro::create($datos);
            
            // Devolver mensaje de éxito junto con los datos del centro
            return response()->json([
                'message' => 'Centro creado exitosamente',
                'centro' => $centro
            ], 201);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al crear el centro',
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
            $centro = Centro::findOrFail($id);
            return response()->json($centro);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Centro no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Buscar el centro por ID
        $centro = Centro::findOrFail($id);
            
            // Validar los datos de entrada
            $request->validate([
                'nombre_centro' => 'required|string|max:255',
                'estado' => 'required|boolean',
                'municipio_id' => 'required|exists:municipios,id_municipio',
            ]);
            
            // Preparar los datos del centro
            $datos = $request->all();
            
            // Actualizar la fecha de modificación
            $datos['fecha_modificacion'] = now();
            
            // Actualizar el centro
            $centro->update($datos);
            
            // Devolver mensaje de éxito junto con los datos actualizados
            return response()->json([
                'message' => 'Centro actualizado exitosamente',
                'centro' => $centro
            ]);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al actualizar el centro',
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
            // Buscar el centro por ID
            $centro = Centro::findOrFail($id);
            
            // Eliminar el centro
            $centro->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Centro eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar el centro',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 