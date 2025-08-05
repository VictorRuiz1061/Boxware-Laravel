<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Requests\AreaRequest;
use App\Http\Middleware\IsUserAuth;

class AreaController extends Controller
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
            $areas = Area::with('sede')->get();
            return response()->json($areas);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las áreas',
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
    public function store(AreaRequest $request)
    {
        try {
            // Los datos ya están validados por AreaRequest
            // Preparar los datos del área
            $datos = $request->validated();
            
            // Asignar fechas si no están presentes
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
            // Crear el área
            $area = Area::create($datos);
            
            // Cargar la relación de sede
            $area->load('sede');
            
            // Devolver mensaje de éxito junto con los datos del área
            return response()->json([
                'message' => 'Área creada exitosamente',
                'area' => $area
            ], 201);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al crear el área',
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
            $area = Area::with('sede')->findOrFail($id);
            return response()->json($area);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Área no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AreaRequest $request, $id)
    {
        try {
            // Buscar el área por ID
            $area = Area::findOrFail($id);
            
            // Los datos ya están validados por AreaRequest
            // Preparar los datos del área
            $datos = $request->validated();
            
            // Actualizar la fecha de modificación
            $datos['fecha_modificacion'] = now();
            
            // Actualizar el área
            $area->update($datos);
            
            // Cargar la relación de sede
            $area->load('sede');
            
            // Devolver mensaje de éxito junto con los datos actualizados
            return response()->json([
                'message' => 'Área actualizada exitosamente',
                'area' => $area
            ]);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al actualizar el área',
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
            // Buscar el área por ID
            $area = Area::findOrFail($id);
            
            // Guardar el nombre para incluirlo en la respuesta
            $nombreArea = $area->nombre_area;
            
            // Eliminar el área
            $area->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Área eliminada exitosamente',
            ], 200);
            
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar el área',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
