@extends('layouts.app')

@section('title', 'Tipos de Movimiento | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Tipos de Movimiento</h2>
    <a href="{{ route('tipo_movimiento.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Tipo de Movimiento</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Tipo de movimiento</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tiposMovimiento as $tipoMovimiento)
                <tr>
                    <td class="px-4 py-2">{{ $tipoMovimiento->id_tipo_movimiento }}</td>
                    <td class="px-4 py-2">{{ $tipoMovimiento->tipo_movimiento }}</td>
                    <td class="px-4 py-2">
                        @if($tipoMovimiento->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('tipo_movimiento.edit', $tipoMovimiento->id_tipo_movimiento) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No hay tipos de movimiento registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 