<?php

namespace App\Http\Controllers;

use App\Models\Sitio;
use Illuminate\Http\Request;
use App\Http\Middleware\IsUserAuth;

class SitioController extends Controller
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
            $sitios = Sitio::with('tipoSitio')->get();
            return response()->json($sitios);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los sitios',
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
                'nombre_sitio' => 'required|string|max:255',
                'ubicacion' => 'required|string|max:255',
                'fecha_tecnica' => 'required|date',
                'estado' => 'required|boolean',
                'tipo_sitio_id' => 'required|exists:tipos_sitio,id_tipo_sitio',
            ]);
            
            // Preparar los datos del sitio
            $datos = $request->all();
            
            // Asignar fechas si no están presentes
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
            // Crear el sitio
            $sitio = Sitio::create($datos);
            
            // Cargar la relación con tipo de sitio
            $sitio->load('tipoSitio');
            
            // Devolver mensaje de éxito junto con los datos del sitio
            return response()->json([
                'message' => 'Sitio creado exitosamente',
                'sitio' => $sitio
            ], 201);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al crear el sitio',
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
            $sitio = Sitio::with('tipoSitio')->findOrFail($id);
            return response()->json($sitio);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Sitio no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sitio $sitio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Buscar el sitio por ID
            $sitio = Sitio::findOrFail($id);
            
            // Validar los datos de entrada
            $request->validate([
                'nombre_sitio' => 'required|string|max:255',
                'ubicacion' => 'required|string|max:255',
                'fecha_tecnica' => 'required|date',
                'estado' => 'required|boolean',
                'tipo_sitio_id' => 'required|exists:tipos_sitio,id_tipo_sitio',
            ]);
            
            // Preparar los datos del sitio
            $datos = $request->all();
            
            // Actualizar la fecha de modificación
            $datos['fecha_modificacion'] = now();
            
            // Actualizar el sitio
            $sitio->update($datos);
            
            // Cargar la relación con tipo de sitio
            $sitio->load('tipoSitio');
            
            // Devolver mensaje de éxito junto con los datos actualizados
            return response()->json([
                'message' => 'Sitio actualizado exitosamente',
                'sitio' => $sitio
            ]);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al actualizar el sitio',
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
            // Buscar el sitio por ID
            $sitio = Sitio::findOrFail($id);
            
            // Guardar el nombre para incluirlo en la respuesta
            $nombreSitio = $sitio->nombre_sitio;
            
            // Eliminar el sitio
            $sitio->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Sitio eliminado exitosamente',
            ], 200);
            
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar el sitio',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
