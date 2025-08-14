<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Inventario;
use App\Models\TipoMovimiento;
use App\Services\InventarioService;
use Illuminate\Http\Request;
use Exception;

class MovimientoController extends Controller
{
    protected $inventarioService;

    public function __construct(InventarioService $inventarioService)
    {
        $this->inventarioService = $inventarioService;
    }

    public function index()
    {
        $movimientos = \App\Models\Movimiento::with(['tipoMovimiento', 'usuarioMovimiento', 'material', 'sitio'])->get();
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
        // Debugging - guardar todos los datos recibidos
        \Log::info('Datos recibidos en MovimientoController@store:', $request->all());
        
        try {
            // Validación básica para todos los tipos de movimiento
            $baseRules = [
                'tipo_movimiento_id' => 'required|exists:tipos_movimiento,id_tipo_movimiento',
                'material_id' => 'required|exists:materiales,id_material',
                'cantidad' => 'required|integer|min:1',
                'usuario_movimiento_id' => 'required|exists:usuarios,id_usuario',
            ];
            
            // Obtener el tipo de movimiento
            $tipoMovimiento = TipoMovimiento::find($request->tipo_movimiento_id);
            if (!$tipoMovimiento) {
                return back()->with('error', 'Tipo de movimiento no válido')->withInput();
            }
            
            // Reglas específicas según el tipo de movimiento
            $specificRules = [];
            switch (strtolower($tipoMovimiento->tipo_movimiento)) {
                case 'prestamo':
                case 'préstamo':
                case 'traslado':
                case 'devolucion':
                case 'devolución':
                    // Validar los campos de origen y destino que vienen del formulario
                    // (no se guardarán directamente en la BD)
                    $request->validate([
                        'sitio_origen_id' => 'required|exists:sitios,id_sitio',
                        'sitio_destino_id' => 'required|exists:sitios,id_sitio',
                    ]);
                    // No requerimos sitio_id aquí porque el campo está oculto en el formulario.
                    // Más adelante asignamos sitio_id = sitio_origen_id antes de guardar.
                    $specificRules = [];
                    break;
                default:
                    $specificRules = [
                        'sitio_id' => 'required|exists:sitios,id_sitio',
                    ];
                    break;
            }
            
            // Combinar reglas y validar
            $rules = array_merge($baseRules, $specificRules);
            $validated = $request->validate($rules);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Error de validación:', ['errors' => $e->errors()]);
            return back()->with('error', 'Error de validación: ' . implode(', ', array_map(function($err) { return $err[0]; }, $e->errors())))->withInput();
        }
    
        try {
            $tipoMovimiento = TipoMovimiento::find($validated['tipo_movimiento_id']);
    
            // Validaciones extra según el tipo de movimiento
            switch (strtolower($tipoMovimiento->tipo_movimiento)) {
                case 'salida':
                    if (!$this->inventarioService->verificarStockDisponible(
                        $validated['material_id'],
                        $validated['sitio_id'],
                        $validated['cantidad']
                    )) {
                        return back()->with('error', 'No hay suficiente stock para realizar la salida')->withInput();
                    }
                    break;
    
                case 'traslado':
                case 'prestamo':
                case 'devolucion':
                    if (empty($validated['sitio_origen_id']) || empty($validated['sitio_destino_id'])) {
                        return back()->with('error', 'Debe seleccionar sitio origen y destino')->withInput();
                    }
                    break;
            }
    
            // Añadir campos adicionales necesarios
            $datos = $validated;
            $datos['estado'] = 1; // Activo por defecto
            $datos['fecha_creacion'] = now();
            $datos['fecha_modificacion'] = now();
            $datos['usuario_id'] = $request->input('usuario_movimiento_id'); // Usuario que realiza el movimiento
            
            // Manejar los campos de sitio según el tipo de movimiento
            switch (strtolower($tipoMovimiento->tipo_movimiento)) {
                case 'prestamo':
                case 'préstamo':
                case 'traslado':
                case 'devolucion':
                case 'devolución':
                    // Para estos tipos, usamos el sitio_id del formulario
                    // pero guardamos los valores de origen y destino para procesamiento
                    $datos['sitio_id'] = $request->input('sitio_origen_id');
                    
                    // Guardar temporalmente estos valores para el servicio
                    $sitioOrigenId = $request->input('sitio_origen_id');
                    $sitioDestinoId = $request->input('sitio_destino_id');
                    break;
                default:
                    // Para otros tipos, ya tenemos el sitio_id
                    break;
            }
            
            // Registrar el movimiento
            $movimiento = Movimiento::create($datos);
            
            // Procesar el movimiento según su tipo
            switch (strtolower($tipoMovimiento->tipo_movimiento)) {
                case 'entrada':
                    $this->inventarioService->procesarEntrada($movimiento);
                    break;
                case 'salida':
                    $this->inventarioService->procesarSalida($movimiento);
                    break;
                case 'prestamo':
                case 'préstamo':
                    // Asignar temporalmente los valores para el procesamiento
                    $movimiento->sitio_origen_id = $sitioOrigenId;
                    $movimiento->sitio_destino_id = $sitioDestinoId;
                    $this->inventarioService->procesarPrestamo($movimiento);
                    break;
                case 'traslado':
                    // Asignar temporalmente los valores para el procesamiento
                    $movimiento->sitio_origen_id = $sitioOrigenId;
                    $movimiento->sitio_destino_id = $sitioDestinoId;
                    $this->inventarioService->procesarTraslado($movimiento);
                    break;
                case 'devolucion':
                case 'devolución':
                    // Asignar temporalmente los valores para el procesamiento
                    $movimiento->sitio_origen_id = $sitioOrigenId;
                    $movimiento->sitio_destino_id = $sitioDestinoId;
                    $this->inventarioService->procesarDevolucion($movimiento);
                    break;
                default:
                    throw new Exception('Tipo de movimiento no soportado');
            }
    
            return redirect()->route('movimientos.index')
                ->with('success', 'Movimiento registrado con éxito');
    
        } catch (Exception $e) {
            return back()->with('error', 'Error al registrar el movimiento: ' . $e->getMessage())->withInput();
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $movimiento = Movimiento::with(['tipoMovimiento', 'usuarioMovimiento', 'material', 'sitio'])->find($id);
            
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
            
            $datos = $request->all();
            $datos['fecha_modificacion'] = now();
            
            $movimiento->update($datos);
            
            return redirect()->route('movimientos.index')->with('success', 'Movimiento actualizado exitosamente');
        } catch (Exception $e) {
            return back()->with('error', 'Error al actualizar el movimiento: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Nota: No se permite eliminar movimientos ya que afectaría la trazabilidad
            // del inventario. En su lugar, se debe crear un movimiento de corrección.
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