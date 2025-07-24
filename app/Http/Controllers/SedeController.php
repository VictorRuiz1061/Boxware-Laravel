<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use App\Http\Requests\SedeRequest;
use App\Http\Middleware\IsUserAuth;

class SedeController extends Controller
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
            $sedes = Sede::with('centro')->get();
            return response()->json($sedes);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las sedes',
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
    public function store(SedeRequest $request)
    {
        try {
            // Los datos ya están validados por SedeRequest
            // Preparar los datos de la sede
            $datos = $request->validated();
            
            // Asignar fechas si no están presentes
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
            // Crear la sede
            $sede = Sede::create($datos);
            
            // Cargar la relación de centro
            $sede->load('centro');
            
            // Devolver mensaje de éxito junto con los datos de la sede
            return response()->json([
                'message' => 'Sede creada exitosamente',
                'sede' => $sede
            ], 201);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al crear la sede',
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
            $sede = Sede::with('centro')->findOrFail($id);
            return response()->json($sede);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Sede no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sede $sede)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SedeRequest $request, $id)
    {
        try {
            // Buscar la sede por ID
            $sede = Sede::findOrFail($id);
            
            // Los datos ya están validados por SedeRequest
            // Preparar los datos de la sede
            $datos = $request->validated();
            
            // Actualizar la fecha de modificación
            $datos['fecha_modificacion'] = now();
            
            // Actualizar la sede
            $sede->update($datos);
            
            // Cargar la relación de centro
            $sede->load('centro');
            
            // Devolver mensaje de éxito junto con los datos actualizados
            return response()->json([
                'message' => 'Sede actualizada exitosamente',
                'sede' => $sede
            ]);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al actualizar la sede',
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
            // Buscar la sede por ID
            $sede = Sede::findOrFail($id);
            
            // Guardar el nombre para incluirlo en la respuesta
            $nombreSede = $sede->nombre_sede;
            
            // Eliminar la sede
            $sede->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Sede eliminada exitosamente',
            ], 200);
            
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar la sede',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
