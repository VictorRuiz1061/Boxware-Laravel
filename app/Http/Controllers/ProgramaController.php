<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use App\Http\Middleware\IsUserAuth;

class ProgramaController extends Controller
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
            $programas = Programa::with('area.sede')->get();
            return response()->json($programas);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los programas',
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
                'nombre_programa' => 'required|string|max:255',
                'estado' => 'required|boolean',
                'area_id' => 'required|exists:areas,id_area',
            ]);
            
            // Preparar los datos del programa
            $datos = $request->all();
            
            // Asignar fechas si no están presentes
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
            // Crear el programa
            $programa = Programa::create($datos);
            
            // Cargar la relación de área y sede
            $programa->load('area.sede');
            
            // Devolver mensaje de éxito junto con los datos del programa
            return response()->json([
                'message' => 'Programa creado exitosamente',
                'programa' => $programa
            ], 201);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al crear el programa',
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
            $programa = Programa::with('area.sede')->findOrFail($id);
            return response()->json($programa);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Programa no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programa $programa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Buscar el programa por ID
            $programa = Programa::findOrFail($id);
            
            // Validar los datos de entrada
            $request->validate([
                'nombre_programa' => 'required|string|max:255',
                'estado' => 'required|boolean',
                'area_id' => 'required|exists:areas,id_area',
            ]);
            
            // Preparar los datos del programa
            $datos = $request->all();
            
            // Actualizar la fecha de modificación
            $datos['fecha_modificacion'] = now();
            
            // Actualizar el programa
            $programa->update($datos);
            
            // Cargar la relación de área y sede
            $programa->load('area.sede');
            
            // Devolver mensaje de éxito junto con los datos actualizados
            return response()->json([
                'message' => 'Programa actualizado exitosamente',
                'programa' => $programa
            ]);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al actualizar el programa',
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
            // Buscar el programa por ID
            $programa = Programa::findOrFail($id);
            
            // Guardar el nombre para incluirlo en la respuesta
            $nombrePrograma = $programa->nombre_programa;
            
            // Eliminar el programa
            $programa->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Programa eliminado exitosamente',
            ], 200);
            
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar el programa',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
