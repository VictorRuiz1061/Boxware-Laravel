@extends('layouts.app')

@section('title', 'Movimientos | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-white">Movimientos</h2>
    <a href="{{ route('movimientos.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Movimiento</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Cantidad</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Usuario Movimiento</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Usuario Responsable</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Material</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Tipo de Movimiento</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Sitio</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Sitio Origen</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Sitio Destino</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movimientos as $movimiento)
                <tr>
                    <td class="px-4 py-2">{{ $movimiento->id_movimiento }}</td>
                    <td class="px-4 py-2">{{ $movimiento->cantidad }}</td>
                    <td class="px-4 py-2">{{ $movimiento->usuarioMovimiento ? $movimiento->usuarioMovimiento->nombre : 'Sin usuario' }}</td>
                    <td class="px-4 py-2">{{ $movimiento->usuarioResponsable ? $movimiento->usuarioResponsable->nombre : 'Sin usuario' }}</td>
                    <td class="px-4 py-2">{{ $movimiento->material ? $movimiento->material->nombre_material : 'Sin material' }}</td>
                    <td class="px-4 py-2">{{ $movimiento->tipoMovimiento ? $movimiento->tipoMovimiento->tipo_movimiento : 'Sin tipo' }}</td>
                    <td class="px-4 py-2">{{ $movimiento->sitio ? $movimiento->sitio->nombre_sitio : 'Sin sitio' }}</td>
                    <td class="px-4 py-2">{{ $movimiento->sitioOrigen ? $movimiento->sitioOrigen->nombre_sitio : 'Sin origen' }}</td>
                    <td class="px-4 py-2">{{ $movimiento->sitioDestino ? $movimiento->sitioDestino->nombre_sitio : 'Sin destino' }}</td>
                    <td class="px-4 py-2">
                        @if($movimiento->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('movimientos.edit', $movimiento->id_movimiento) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center py-4">No hay movimientos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 