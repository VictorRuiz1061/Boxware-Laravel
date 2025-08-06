<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Inventario;
use App\Services\InventarioService;
use Illuminate\Http\Request;
use Exception;

class MovimientoController extends Controller
{
<<<<<<< Updated upstream
    /**
     * Display a listing of the resource.
     */
=======
    protected $inventarioService;

    public function __construct(InventarioService $inventarioService)
    {
        $this->inventarioService = $inventarioService;
    }

>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                'estado' => 'required|string|max:50',
                'cantidad' => 'required|integer',
                'usuario_id' => 'required|exists:usuarios,id_usuario',
                'tipo_movimiento_id' => 'required|exists:tipos_movimiento,id_tipo_movimiento',
                'material_id' => 'required|exists:materiales,id_material',
                'sitio_id' => 'required|exists:sitios,id_sitio',
=======
                'estado' => 'required|boolean',
                'cantidad' => 'required|integer|min:1',
                'sitio_id' => 'required|exists:sitios,id_sitio',
                'sitio_origen_id' => 'nullable|exists:sitios,id_sitio',
                'sitio_destino_id' => 'nullable|exists:sitios,id_sitio',
                'usuario_movimiento_id' => 'required|exists:usuarios,id_usuario',
                'usuario_responsable_id' => 'required|exists:usuarios,id_usuario',
                'tipo_movimiento_id' => 'required|exists:tipos_movimiento,id_tipo_movimiento',
                'material_id' => 'required|exists:materiales,id_material',
>>>>>>> Stashed changes
            ]);

            $datos = $request->all();
            
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
<<<<<<< Updated upstream
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
=======
            // Usar el servicio para registrar el movimiento y actualizar el inventario
            $movimiento = $this->inventarioService->registrarMovimiento($datos);
            
            return redirect()->route('movimientos.index')->with('success', 'Movimiento registrado y inventario actualizado exitosamente');
        } catch (Exception $e) {
            return back()->with('error', 'Error al registrar el movimiento: ' . $e->getMessage())->withInput();
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
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
            
=======
            $movimiento = Movimiento::findOrFail($id);
            
            $request->validate([
                'estado' => 'required|boolean',
                'cantidad' => 'required|integer|min:1',
                'sitio_id' => 'required|exists:sitios,id_sitio',
                'sitio_origen_id' => 'nullable|exists:sitios,id_sitio',
                'sitio_destino_id' => 'nullable|exists:sitios,id_sitio',
                'usuario_movimiento_id' => 'required|exists:usuarios,id_usuario',
                'usuario_responsable_id' => 'required|exists:usuarios,id_usuario',
                'tipo_movimiento_id' => 'required|exists:tipos_movimiento,id_tipo_movimiento',
                'material_id' => 'required|exists:materiales,id_material',
            ]);
            
            // Nota: La actualización de movimientos existentes no modifica el inventario
            // ya que podría causar inconsistencias. Para modificar el inventario, se debe
            // crear un nuevo movimiento de corrección.
            
>>>>>>> Stashed changes
            $datos = $request->all();
            $datos['fecha_modificacion'] = now();
            
            $movimiento->update($datos);
            
<<<<<<< Updated upstream
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
=======
            return redirect()->route('movimientos.index')->with('success', 'Movimiento actualizado exitosamente');
        } catch (Exception $e) {
            return back()->with('error', 'Error al actualizar el movimiento: ' . $e->getMessage())->withInput();
>>>>>>> Stashed changes
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
<<<<<<< Updated upstream
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
=======
            // Nota: No se permite eliminar movimientos ya que afectaría la trazabilidad
            // del inventario. En su lugar, se debe crear un movimiento de corrección.
>>>>>>> Stashed changes
            return response()->json([
                'status' => 'error',
                'message' => 'No se permite eliminar movimientos para mantener la trazabilidad del inventario. Cree un movimiento de corrección si es necesario.'
            ], 403);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al procesar la solicitud',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Muestra el historial de movimientos de un material específico
     */
    public function historialMaterial($materialId)
    {
        try {
            $historial = $this->inventarioService->obtenerHistorialMaterial($materialId);
            $material = \App\Models\Material::findOrFail($materialId);
            
            return view('movimientos.historial', compact('historial', 'material'));
        } catch (Exception $e) {
            return back()->with('error', 'Error al obtener el historial: ' . $e->getMessage());
        }
    }
    
    /**
     * Muestra el inventario actual de un sitio específico
     */
    public function inventarioSitio($sitioId)
    {
        try {
            $inventario = $this->inventarioService->obtenerInventarioSitio($sitioId);
            $sitio = \App\Models\Sitio::findOrFail($sitioId);
            
            return view('movimientos.inventario_sitio', compact('inventario', 'sitio'));
        } catch (Exception $e) {
            return back()->with('error', 'Error al obtener el inventario: ' . $e->getMessage());
        }
    }
    
    /**
     * Verifica si hay stock disponible (útil para llamadas AJAX)
     */
    public function verificarStock(Request $request)
    {
        try {
            $request->validate([
                'material_id' => 'required|exists:materiales,id_material',
                'sitio_id' => 'required|exists:sitios,id_sitio',
                'cantidad' => 'required|integer|min:1',
            ]);
            
            $disponible = $this->inventarioService->verificarStockDisponible(
                $request->material_id,
                $request->sitio_id,
                $request->cantidad
            );
            
            return response()->json([
                'status' => 'success',
                'disponible' => $disponible
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
