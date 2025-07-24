<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;
use Exception;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsUserAuth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $inventario = Inventario::with('sitio')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Lista de inventario obtenida correctamente',
                'data' => $inventario
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener la lista de inventario',
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
            $request->validate([
                'stock' => 'required|integer',
                'placa_sena' => 'required|string',
                'descripcion' => 'required|string',
                'sitio_id' => 'required|exists:sitios,id_sitio',
            ]);

        $inventario = Inventario::create($request->all());
            
            return response()->json([
                'status' => 'success',
                'message' => 'Elemento de inventario creado correctamente',
                'data' => $inventario
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el elemento de inventario',
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
            $inventario = Inventario::with('sitio')->find($id);
            
            if (!$inventario) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Elemento de inventario no encontrado'
                ], 404);
            }
            
            return response()->json([
                'status' => 'success',
                'message' => 'Elemento de inventario obtenido correctamente',
                'data' => $inventario
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener el elemento de inventario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $inventario = Inventario::find($id);
            
            if (!$inventario) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Elemento de inventario no encontrado'
                ], 404);
            }
            
            $request->validate([
                'stock' => 'integer',
                'placa_sena' => 'string',
                'descripcion' => 'string',
                'sitio_id' => 'exists:sitios,id_sitio',
            ]);
            
        $inventario->update($request->all());
            
            return response()->json([
                'status' => 'success',
                'message' => 'Elemento de inventario actualizado correctamente',
                'data' => $inventario
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar el elemento de inventario',
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
            $inventario = Inventario::find($id);
            
            if (!$inventario) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Elemento de inventario no encontrado'
                ], 404);
            }
            
        $inventario->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Elemento de inventario eliminado correctamente'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar el elemento de inventario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
