<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Http\Requests\MunicipioRequest;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Support\Facades\DB;

class MunicipioController extends Controller
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
        return Municipio::all();
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
    public function store(MunicipioRequest $request)
    {
        try {
            // Los datos ya están validados por MunicipioRequest
            // Preparar los datos del municipio
            $datos = $request->validated();
            
            // Asignar fechas si no están presentes
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
            // Crear el municipio
            $municipio = Municipio::create($datos);
            
            // Devolver mensaje de éxito junto con los datos del municipio
            return response()->json([
                'message' => 'Municipio creado exitosamente',
                'municipio' => $municipio
            ], 201);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al crear el municipio',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Municipio $municipio)
    {
        return $municipio;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Municipio $municipio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MunicipioRequest $request, $id)
    {
        try {
            // Buscar el municipio por ID
            $municipio = Municipio::findOrFail($id);
            
            // Los datos ya están validados por MunicipioRequest
            // Preparar los datos del municipio
            $datos = $request->validated();
            
            // Actualizar la fecha de modificación
            $datos['fecha_modificacion'] = now();
            
            // Actualizar el municipio
            $municipio->update($datos);
            
            // Devolver mensaje de éxito junto con los datos actualizados
            return response()->json([
                'message' => 'Municipio actualizado exitosamente',
                'municipio' => $municipio
            ]);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al actualizar el municipio',
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
            // Buscar el municipio por ID
            $municipio = Municipio::findOrFail($id);
            
            // Guardar el nombre para incluirlo en la respuesta
            $nombreMunicipio = $municipio->nombre_municipio;
            
            // Eliminar el municipio
            $municipio->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Municipio eliminado exitosamente'
            ], 200);
            
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar el municipio',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
