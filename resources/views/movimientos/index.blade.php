@extends('layouts.app')

@section('title', 'Movimientos | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Movimientos</h2>
    <a href="{{ route('movimientos.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Movimiento</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Cantidad</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Fechas creacion</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Fecha actualizacion</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Usuario</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Material</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Tipo de movimiento</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Sitio</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movimientos as $movimiento)
                <tr>
                    <td class="px-4 py-2">{{ $movimiento->id_movimiento }}</td>
                    <td class="px-4 py-2">{{ $movimiento->cantidad }}</td>
                    <td class="px-4 py-2">{{ $movimiento->fecha_creacion }}</td>
                    <td class="px-4 py-2">{{ $movimiento->fecha_actualizacion }}</td>
                    <td class="px-4 py-2">{{ $movimiento->usuario_id ? $movimiento->usuario->nombre : 'Sin usuario' }}</td>
                    <td class="px-4 py-2">{{ $movimiento->material_id ? $movimiento->material->nombre_material : 'Sin material' }}</td>
                    <td class="px-4 py-2">{{ $movimiento->tipo_movimiento_id ? $movimiento->tipo_movimiento->nombre_tipo_movimiento : 'Sin tipo de movimiento' }}</td>
                    <td class="px-4 py-2">{{ $movimiento->sitio_id ? $movimiento->sitio->nombre_sitio : 'Sin sitio' }}</td>
                    <td class="px-4 py-2">
                        @if($usuario->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No hay movimientos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 