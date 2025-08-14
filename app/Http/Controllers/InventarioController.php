<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Sitio;
use App\Models\Material;
use App\Services\InventarioService;
use Illuminate\Http\Request;
use Exception;

class InventarioController extends Controller
{
    protected $inventarioService;

    public function __construct(InventarioService $inventarioService)
    {
        $this->inventarioService = $inventarioService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $inventario = Inventario::with(['sitio', 'material'])->get();
            return view('inventario.index', compact('inventario'));
        } catch (Exception $e) {
            return back()->with('error', 'Error al obtener la lista de inventario: ' . $e->getMessage());
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
                'stock' => 'required|integer|min:0',
                'placa_sena' => 'required|string',
                'descripcion' => 'required|string',
                'material_id' => 'required|exists:materiales,id_material',
                'sitio_id' => 'required|exists:sitios,id_sitio',
            ]);

            // Verificar si ya existe un registro para este material en este sitio
            $existente = Inventario::where('material_id', $request->material_id)
                ->where('sitio_id', $request->sitio_id)
                ->first();

            if ($existente) {
                return back()->with('error', 'Ya existe un registro de inventario para este material en este sitio. Use la opción de actualizar.')
                    ->withInput();
            }

            // Si es un registro nuevo, crear un movimiento de entrada para mantener la trazabilidad
            $movimientoData = [
                'estado' => true,
                'cantidad' => $request->stock,
                'material_id' => $request->material_id,
                'sitio_id' => $request->sitio_id,
                'usuario_movimiento_id' => auth()->id() ?? 1, // Ajustar según tu sistema de autenticación
                'usuario_responsable_id' => auth()->id() ?? 1, // Ajustar según tu sistema de autenticación
                'tipo_movimiento_id' => $this->getTipoMovimientoEntrada(), // Obtener ID del tipo "entrada"
                'fecha_creacion' => now(),
                'fecha_modificacion' => now()
            ];

            // Usar el servicio para registrar el movimiento y actualizar el inventario
            $this->inventarioService->registrarMovimiento($movimientoData);
            
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
            $inventario = Inventario::with(['sitio', 'material'])->find($id);
            
            if (!$inventario) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Elemento de inventario no encontrado'
                ], 404);
            }
            
            // Obtener historial de movimientos para este material en este sitio
            $historial = $this->inventarioService->obtenerHistorialMaterial($inventario->material_id);
            
            return view('inventario.show', compact('inventario', 'historial'));
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
        $sitios = Sitio::all();
        $materiales = Material::all();
        return view('inventario.edit', compact('inventario', 'sitios', 'materiales'));
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
                'stock' => 'integer|min:0',
                'placa_sena' => 'string',
                'descripcion' => 'string',
            ]);
            
            // Si cambia el stock, registrar un movimiento de ajuste para mantener la trazabilidad
            if (isset($request->stock) && $request->stock != $inventario->stock) {
                $diferencia = $request->stock - $inventario->stock;
                $tipoMovimientoId = $diferencia > 0 
                    ? $this->getTipoMovimientoEntrada() // Ajuste positivo (entrada)
                    : $this->getTipoMovimientoSalida(); // Ajuste negativo (salida)
                
                $movimientoData = [
                    'estado' => true,
                    'cantidad' => abs($diferencia),
                    'material_id' => $inventario->material_id,
                    'sitio_id' => $inventario->sitio_id,
                    'usuario_movimiento_id' => auth()->id() ?? 1, // Ajustar según tu sistema de autenticación
                    'usuario_responsable_id' => auth()->id() ?? 1, // Ajustar según tu sistema de autenticación
                    'tipo_movimiento_id' => $tipoMovimientoId,
                    'fecha_creacion' => now(),
                    'fecha_modificacion' => now()
                ];
                
                // Usar el servicio para registrar el movimiento y actualizar el inventario
                $this->inventarioService->registrarMovimiento($movimientoData);
            } else {
                // Si solo cambian otros campos, actualizar directamente
                $inventario->update($request->all());
            }
            
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
            
            // Registrar un movimiento de salida total para mantener la trazabilidad
            if ($inventario->stock > 0) {
                $movimientoData = [
                    'estado' => true,
                    'cantidad' => $inventario->stock,
                    'material_id' => $inventario->material_id,
                    'sitio_id' => $inventario->sitio_id,
                    'usuario_movimiento_id' => auth()->id() ?? 1, // Ajustar según tu sistema de autenticación
                    'usuario_responsable_id' => auth()->id() ?? 1, // Ajustar según tu sistema de autenticación
                    'tipo_movimiento_id' => $this->getTipoMovimientoSalida(), // Obtener ID del tipo "salida"
                    'fecha_creacion' => now(),
                    'fecha_modificacion' => now()
                ];
                
                // Usar el servicio para registrar el movimiento y actualizar el inventario
                $this->inventarioService->registrarMovimiento($movimientoData);
            }
            
            // Eliminar el registro de inventario
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
    
    /**
     * Obtiene el ID del tipo de movimiento "entrada"
     */
    private function getTipoMovimientoEntrada()
    {
        $tipoMovimiento = \App\Models\TipoMovimiento::where('tipo_movimiento', 'entrada')
            ->orWhere('tipo_movimiento', 'Entrada')
            ->first();
            
        if (!$tipoMovimiento) {
            throw new Exception('No se encontró el tipo de movimiento "entrada" en la base de datos');
        }
        
        return $tipoMovimiento->id_tipo_movimiento;
    }
    
    /**
     * Obtiene el ID del tipo de movimiento "salida"
     */
    private function getTipoMovimientoSalida()
    {
        $tipoMovimiento = \App\Models\TipoMovimiento::where('tipo_movimiento', 'salida')
            ->orWhere('tipo_movimiento', 'Salida')
            ->first();
            
        if (!$tipoMovimiento) {
            throw new Exception('No se encontró el tipo de movimiento "salida" en la base de datos');
        }
        
        return $tipoMovimiento->id_tipo_movimiento;
    }
    
    /**
     * Muestra el inventario por sitio
     */
    public function inventarioPorSitio($sitioId = null)
    {
        try {
            $sitios = Sitio::all();
            $sitioSeleccionado = null;
            $inventario = collect();
            
            if ($sitioId) {
                $sitioSeleccionado = Sitio::findOrFail($sitioId);
                $inventario = $this->inventarioService->obtenerInventarioSitio($sitioId);
            }
            
            return view('inventario.por_sitio', compact('sitios', 'sitioSeleccionado', 'inventario'));
        } catch (Exception $e) {
            return back()->with('error', 'Error al obtener el inventario: ' . $e->getMessage());
        }
    }
    
    /**
     * Muestra el inventario por material
     */
    public function inventarioPorMaterial($materialId = null)
    {
        try {
            $materiales = Material::all();
            $materialSeleccionado = null;
            $inventario = collect();
            
            if ($materialId) {
                $materialSeleccionado = Material::findOrFail($materialId);
                $inventario = Inventario::with('sitio')
                    ->where('material_id', $materialId)
                    ->get();
            }
            
            return view('inventario.por_material', compact('materiales', 'materialSeleccionado', 'inventario'));
        } catch (Exception $e) {
            return back()->with('error', 'Error al obtener el inventario: ' . $e->getMessage());
        }
    }
}