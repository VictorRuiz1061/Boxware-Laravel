<?php

namespace App\Http\Controllers;

use App\Models\Caracteristica;
use Illuminate\Http\Request;
use App\Http\Middleware\IsUserAuth;

class CaracteristicaController extends Controller
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
            $caracteristicas = Caracteristica::with('material')->get();
            return response()->json($caracteristicas);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las características',
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
                'placa_sena' => 'required|boolean',
                'descripcion' => 'required|boolean',
                'material_id' => 'required|exists:materiales,id_material',
            ]);
            
            // Crear la característica
        $caracteristica = Caracteristica::create($request->all());
            
            // Cargar la relación de material
            $caracteristica->load('material');
            
            // Devolver mensaje de éxito junto con los datos de la característica
            return response()->json([
                'message' => 'Característica creada exitosamente',
                'caracteristica' => $caracteristica
            ], 201);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al crear la característica',
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
            $caracteristica = Caracteristica::with('material')->findOrFail($id);
            return response()->json($caracteristica);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Característica no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caracteristica $caracteristica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Buscar la característica por ID
            $caracteristica = Caracteristica::findOrFail($id);
            
            // Validar los datos de entrada
            $request->validate([
                'placa_sena' => 'required|boolean',
                'descripcion' => 'required|boolean',
                'material_id' => 'required|exists:materiales,id_material',
            ]);
            
            // Actualizar la característica
        $caracteristica->update($request->all());
            
            // Cargar la relación de material
            $caracteristica->load('material');
            
            // Devolver mensaje de éxito junto con los datos actualizados
            return response()->json([
                'message' => 'Característica actualizada exitosamente',
                'caracteristica' => $caracteristica
            ]);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al actualizar la característica',
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
            // Buscar la característica por ID
            $caracteristica = Caracteristica::findOrFail($id);
            
            // Eliminar la característica
        $caracteristica->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Característica eliminada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar la característica',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
