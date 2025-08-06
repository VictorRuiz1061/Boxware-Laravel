<?php

namespace App\Services;

use App\Models\Inventario;
use App\Models\Material;
use App\Models\Movimiento;
use App\Models\Sitio;
use App\Models\TipoMovimiento;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InventarioService
{
    /**
     * Registra un movimiento y actualiza el inventario según el tipo de movimiento
     *
     * @param array $datos Datos del movimiento
     * @return Movimiento
     * @throws Exception
     */
    public function registrarMovimiento(array $datos)
    {
        // Validar que exista el tipo de movimiento
        $tipoMovimiento = TipoMovimiento::find($datos['tipo_movimiento_id']);
        if (!$tipoMovimiento) {
            throw new Exception('El tipo de movimiento no existe');
        }

        // Iniciar transacción para asegurar consistencia de datos
        return DB::transaction(function () use ($datos, $tipoMovimiento) {
            // Crear el registro de movimiento
            $movimiento = Movimiento::create($datos);

            // Actualizar inventario según el tipo de movimiento
            switch (strtolower($tipoMovimiento->tipo_movimiento)) {
                case 'entrada':
                    $this->procesarEntrada($movimiento);
                    break;
                case 'salida':
                    $this->procesarSalida($movimiento);
                    break;
                case 'traslado':
                    $this->procesarTraslado($movimiento);
                    break;
                case 'prestamo':
                    $this->procesarPrestamo($movimiento);
                    break;
                case 'devolucion':
                    $this->procesarDevolucion($movimiento);
                    break;
                default:
                    throw new Exception('Tipo de movimiento no soportado');
            }

            return $movimiento;
        });
    }

    /**
     * Procesa un movimiento de entrada (ingreso de material)
     *
     * @param Movimiento $movimiento
     * @return void
     */
    private function procesarEntrada(Movimiento $movimiento)
    {
        // Buscar si ya existe el material en el inventario del sitio
        $inventario = Inventario::where('material_id', $movimiento->material_id)
            ->where('sitio_id', $movimiento->sitio_id)
            ->first();

        if ($inventario) {
            // Actualizar stock existente
            $inventario->stock += $movimiento->cantidad;
            $inventario->save();
        } else {
            // Crear nuevo registro de inventario
            Inventario::create([
                'stock' => $movimiento->cantidad,
                'placa_sena' => $movimiento->material->codigo_sena ?? '',
                'descripcion' => 'Stock inicial',
                'material_id' => $movimiento->material_id,
                'sitio_id' => $movimiento->sitio_id,
            ]);
        }
    }

    /**
     * Procesa un movimiento de salida (egreso de material)
     *
     * @param Movimiento $movimiento
     * @return void
     * @throws Exception
     */
    private function procesarSalida(Movimiento $movimiento)
    {
        // Verificar que exista el material en el inventario del sitio
        $inventario = Inventario::where('material_id', $movimiento->material_id)
            ->where('sitio_id', $movimiento->sitio_id)
            ->first();

        if (!$inventario) {
            throw new Exception('No existe el material en el inventario del sitio');
        }

        // Verificar que haya suficiente stock
        if ($inventario->stock < $movimiento->cantidad) {
            throw new Exception('No hay suficiente stock para realizar la salida');
        }

        // Actualizar stock
        $inventario->stock -= $movimiento->cantidad;
        $inventario->save();
    }

    /**
     * Procesa un movimiento de traslado entre sitios
     *
     * @param Movimiento $movimiento
     * @return void
     * @throws Exception
     */
    private function procesarTraslado(Movimiento $movimiento)
    {
        // Validar que existan sitio origen y destino
        if (!$movimiento->sitio_origen_id || !$movimiento->sitio_destino_id) {
            throw new Exception('Para un traslado se requiere sitio origen y destino');
        }

        // Verificar inventario en sitio origen
        $inventarioOrigen = Inventario::where('material_id', $movimiento->material_id)
            ->where('sitio_id', $movimiento->sitio_origen_id)
            ->first();

        if (!$inventarioOrigen) {
            throw new Exception('No existe el material en el inventario del sitio origen');
        }

        // Verificar stock suficiente
        if ($inventarioOrigen->stock < $movimiento->cantidad) {
            throw new Exception('No hay suficiente stock en el sitio origen para realizar el traslado');
        }

        // Reducir stock en origen
        $inventarioOrigen->stock -= $movimiento->cantidad;
        $inventarioOrigen->save();

        // Buscar o crear inventario en destino
        $inventarioDestino = Inventario::where('material_id', $movimiento->material_id)
            ->where('sitio_id', $movimiento->sitio_destino_id)
            ->first();

        if ($inventarioDestino) {
            // Actualizar stock existente en destino
            $inventarioDestino->stock += $movimiento->cantidad;
            $inventarioDestino->save();
        } else {
            // Crear nuevo registro de inventario en destino
            Inventario::create([
                'stock' => $movimiento->cantidad,
                'placa_sena' => $inventarioOrigen->placa_sena,
                'descripcion' => 'Traslado desde ' . $movimiento->sitioOrigen->nombre_sitio,
                'material_id' => $movimiento->material_id,
                'sitio_id' => $movimiento->sitio_destino_id,
            ]);
        }
    }

    /**
     * Procesa un movimiento de préstamo
     *
     * @param Movimiento $movimiento
     * @return void
     * @throws Exception
     */
    private function procesarPrestamo(Movimiento $movimiento)
    {
        // Validar que existan sitio origen y destino
        if (!$movimiento->sitio_origen_id || !$movimiento->sitio_destino_id) {
            throw new Exception('Para un préstamo se requiere sitio origen y destino');
        }

        // La lógica es similar al traslado
        $this->procesarTraslado($movimiento);
    }

    /**
     * Procesa un movimiento de devolución
     *
     * @param Movimiento $movimiento
     * @return void
     * @throws Exception
     */
    private function procesarDevolucion(Movimiento $movimiento)
    {
        // Validar que existan sitio origen y destino
        if (!$movimiento->sitio_origen_id || !$movimiento->sitio_destino_id) {
            throw new Exception('Para una devolución se requiere sitio origen y destino');
        }

        // Invertir origen y destino para la devolución
        $temp = $movimiento->sitio_origen_id;
        $movimiento->sitio_origen_id = $movimiento->sitio_destino_id;
        $movimiento->sitio_destino_id = $temp;

        // Usar la lógica de traslado
        $this->procesarTraslado($movimiento);
    }

    /**
     * Obtiene el historial de movimientos de un material
     *
     * @param int $materialId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function obtenerHistorialMaterial($materialId)
    {
        return Movimiento::with(['tipoMovimiento', 'usuarioMovimiento', 'usuarioResponsable', 'sitio', 'sitioOrigen', 'sitioDestino'])
            ->where('material_id', $materialId)
            ->orderBy('fecha_creacion', 'desc')
            ->get();
    }

    /**
     * Obtiene el inventario actual de un sitio
     *
     * @param int $sitioId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function obtenerInventarioSitio($sitioId)
    {
        return Inventario::with('material')
            ->where('sitio_id', $sitioId)
            ->get();
    }

    /**
     * Verifica si hay stock suficiente de un material en un sitio
     *
     * @param int $materialId
     * @param int $sitioId
     * @param int $cantidad
     * @return bool
     */
    public function verificarStockDisponible($materialId, $sitioId, $cantidad)
    {
        $inventario = Inventario::where('material_id', $materialId)
            ->where('sitio_id', $sitioId)
            ->first();

        return $inventario && $inventario->stock >= $cantidad;
    }
}
