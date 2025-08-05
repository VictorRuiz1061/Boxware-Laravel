<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index()
    {
        $movimientos = Movimiento::with(['tipoMovimiento', 'usuarioMovimiento', 'usuarioResponsable', 'material', 'sitio', 'sitioOrigen', 'sitioDestino'])->get();
        return view('movimientos.index', compact('movimientos'));
    }

    public function create()
    {
        $usuarios = \App\Models\Usuario::all();
        $materiales = \App\Models\Material::all();
        $tipo_movimientos = \App\Models\TipoMovimiento::all();
        $sitios = \App\Models\Sitio::all();
        return view('movimientos.create', compact('usuarios', 'materiales', 'tipo_movimientos', 'sitios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estado' => 'required|boolean',
            'cantidad' => 'required|integer',
            'sitio_id' => 'required|exists:sitios,id_sitio',
            'sitio_origen_id' => 'nullable|exists:sitios,id_sitio',
            'sitio_destino_id' => 'nullable|exists:sitios,id_sitio',
            'usuario_movimiento_id' => 'required|exists:usuarios,id_usuario',
            'usuario_responsable_id' => 'required|exists:usuarios,id_usuario',
            'tipo_movimiento_id' => 'required|exists:tipos_movimiento,id_tipo_movimiento',
            'material_id' => 'required|exists:materiales,id_material',
        ]);

        $datos = $request->all();
        
        if (!isset($datos['fecha_creacion'])) {
            $datos['fecha_creacion'] = now();
        }
        
        if (!isset($datos['fecha_modificacion'])) {
            $datos['fecha_modificacion'] = now();
        }
        
        Movimiento::create($datos);
        
        return redirect()->route('movimientos.index')->with('success', 'Movimiento creado exitosamente');
    }

    public function show($id)
    {
        try {
            $movimiento = Movimiento::with(['tipoMovimiento', 'usuarioMovimiento', 'usuarioResponsable', 'material', 'sitio', 'sitioOrigen', 'sitioDestino'])->find($id);
            
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
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener el movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $movimiento = Movimiento::findOrFail($id);
        $usuarios = \App\Models\Usuario::all();
        $materiales = \App\Models\Material::all();
        $tipo_movimientos = \App\Models\TipoMovimiento::all();
        $sitios = \App\Models\Sitio::all();
        return view('movimientos.edit', compact('movimiento', 'usuarios', 'materiales', 'tipo_movimientos', 'sitios'));
    }

    public function update(Request $request, $id)
    {
        $movimiento = Movimiento::findOrFail($id);
        
        $request->validate([
            'estado' => 'required|boolean',
            'cantidad' => 'required|integer',
            'sitio_id' => 'required|exists:sitios,id_sitio',
            'sitio_origen_id' => 'nullable|exists:sitios,id_sitio',
            'sitio_destino_id' => 'nullable|exists:sitios,id_sitio',
            'usuario_movimiento_id' => 'required|exists:usuarios,id_usuario',
            'usuario_responsable_id' => 'required|exists:usuarios,id_usuario',
            'tipo_movimiento_id' => 'required|exists:tipos_movimiento,id_tipo_movimiento',
            'material_id' => 'required|exists:materiales,id_material',
        ]);
        
        $datos = $request->all();
        $datos['fecha_modificacion'] = now();
        
        $movimiento->update($datos);
        
        return redirect()->route('movimientos.index')->with('success', 'Movimiento actualizado exitosamente');
    }

    public function destroy($id)
    {
        try {
            $movimiento = Movimiento::findOrFail($id);
            $movimiento->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Movimiento eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar el movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
