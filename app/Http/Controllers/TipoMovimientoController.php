<?php

namespace App\Http\Controllers;

use App\Models\TipoMovimiento;
use Illuminate\Http\Request;
use Exception;

class TipoMovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposMovimiento = \App\Models\TipoMovimiento::all();
        return view('tipo_movimiento.index', compact('tiposMovimiento'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo_movimiento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_movimiento' => 'required|string|max:100',
            'estado' => 'required|boolean',
        ]);

        $datos = $request->all();
        if (!isset($datos['fecha_creacion'])) {
            $datos['fecha_creacion'] = now();
        }
        if (!isset($datos['fecha_modificacion'])) {
            $datos['fecha_modificacion'] = now();
        }
        $tipoMovimiento = \App\Models\TipoMovimiento::create($datos);
        return redirect()->route('tipo_movimiento.index')->with('success', 'Tipo de movimiento creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $tipoMovimiento = TipoMovimiento::find($id);
            
            if (!$tipoMovimiento) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tipo de movimiento no encontrado'
                ], 404);
            }
            
            return response()->json([
                'status' => 'success',
                'message' => 'Tipo de movimiento obtenido correctamente',
                'data' => $tipoMovimiento
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener el tipo de movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipoMovimiento = \App\Models\TipoMovimiento::findOrFail($id);
        return view('tipo_movimiento.edit', compact('tipoMovimiento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tipoMovimiento = \App\Models\TipoMovimiento::findOrFail($id);
        $request->validate([
            'tipo_movimiento' => 'required|string|max:100',
            'estado' => 'required|boolean',
        ]);
        $datos = $request->all();
        $datos['fecha_modificacion'] = now();
        $tipoMovimiento->update($datos);
        return redirect()->route('tipo_movimiento.index')->with('success', 'Tipo de movimiento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $tipoMovimiento = TipoMovimiento::find($id);
            
            if (!$tipoMovimiento) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tipo de movimiento no encontrado'
                ], 404);
            }
            
        $tipoMovimiento->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Tipo de movimiento eliminado correctamente'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar el tipo de movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
