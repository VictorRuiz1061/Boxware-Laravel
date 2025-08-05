@extends('layouts.app')

@section('title', 'Inventario | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-white">Inventario</h2>
    <a href="{{ route('inventario.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Elemento</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Stock</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Placa SENA</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Descripción</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Material</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Sitio</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventarios as $inventario)
                <tr>
                    <td class="px-4 py-2">{{ $inventario->id_inventario }}</td>
                    <td class="px-4 py-2">{{ $inventario->stock }}</td>
                    <td class="px-4 py-2">{{ $inventario->placa_sena }}</td>
                    <td class="px-4 py-2">{{ $inventario->descripcion }}</td>
                    <td class="px-4 py-2">{{ $inventario->material->nombre_material ?? 'No asignado' }}</td>
                    <td class="px-4 py-2">{{ $inventario->sitio->nombre_sitio ?? 'No asignado' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('inventario.edit', $inventario->id_inventario) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No hay elementos de inventario registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
