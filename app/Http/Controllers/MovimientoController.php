<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\Request;
use Exception;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movimientos = \App\Models\Movimiento::with(['tipoMovimiento', 'usuario', 'material', 'sitio'])->get();
        return view('movimientos.index', compact('movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = \App\Models\Usuario::all();
        $materiales = \App\Models\Material::all();
        $tipo_movimientos = \App\Models\TipoMovimiento::all();
        $sitios = \App\Models\Sitio::all();
        return view('movimientos.create', compact('usuarios', 'materiales', 'tipo_movimientos', 'sitios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'estado' => 'required|string|max:50',
                'cantidad' => 'required|integer',
                'usuario_id' => 'required|exists:usuarios,id_usuario',
                'tipo_movimiento_id' => 'required|exists:tipos_movimiento,id_tipo_movimiento',
                'material_id' => 'required|exists:materiales,id_material',
                'sitio_id' => 'required|exists:sitios,id_sitio',
            ]);

            $datos = $request->all();
            
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
            $movimiento = Movimiento::create($datos);
            
            // Cargar las relaciones
            $movimiento->load(['tipoMovimiento', 'usuario', 'material', 'sitio']);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Movimiento creado correctamente',
                'data' => $movimiento
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el movimiento',
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
            $movimiento = Movimiento::with(['tipoMovimiento', 'usuario', 'material', 'sitio'])->find($id);
            
            if (!$movimiento) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Movimiento no encontrado'
                ], 404);
            }
            
            return response()->json([
                'status' => 'success',
                'message' => 'Movimiento obtenido correctamente',
                'data' => $movimiento
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener el movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $movimiento = \App\Models\Movimiento::findOrFail($id);
        $usuarios = \App\Models\Usuario::all();
        $materiales = \App\Models\Material::all();
        $tipo_movimientos = \App\Models\TipoMovimiento::all();
        $sitios = \App\Models\Sitio::all();
        return view('movimientos.edit', compact('movimiento', 'usuarios', 'materiales', 'tipo_movimientos', 'sitios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $movimiento = Movimiento::find($id);
            
            if (!$movimiento) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Movimiento no encontrado'
                ], 404);
            }
            
            $request->validate([
                'estado' => 'string|max:50',
                'cantidad' => 'integer',
                'usuario_id' => 'exists:usuarios,id_usuario',
                'tipo_movimiento_id' => 'exists:tipos_movimiento,id_tipo_movimiento',
                'material_id' => 'exists:materiales,id_material',
                'sitio_id' => 'exists:sitios,id_sitio',
            ]);
            
            $datos = $request->all();
            $datos['fecha_modificacion'] = now();
            
            $movimiento->update($datos);
            
            // Cargar las relaciones
            $movimiento->load(['tipoMovimiento', 'usuario', 'material', 'sitio']);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Movimiento actualizado correctamente',
                'data' => $movimiento
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar el movimiento',
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
            $movimiento = Movimiento::find($id);
            
            if (!$movimiento) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Movimiento no encontrado'
                ], 404);
            }
            
            $movimiento->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Movimiento eliminado correctamente'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar el movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
