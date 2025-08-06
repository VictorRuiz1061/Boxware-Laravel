@extends('layouts.app')

@section('title', 'Materiales | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-white">Materiales</h2>
    <a href="{{ route('materiales.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Material</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Código SENA</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Nombre</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Descripción</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Unidad</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Peresedero</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Vencimiento</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Tipo</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materiales as $material)
                <tr>
                    <td class="px-4 py-2">{{ $material->id_material }}</td>
                    <td class="px-4 py-2">{{ $material->codigo_sena }}</td>
                    <td class="px-4 py-2">{{ $material->nombre_material }}</td>
                    <td class="px-4 py-2">{{ Str::limit($material->descripcion_material, 50) }}</td>
                    <td class="px-4 py-2">{{ $material->unidad_medida }}</td>
                    <td class="px-4 py-2">
                        @if($material->producto_peresedero)
                            <span class="text-orange-600 font-bold">Sí</span>
                        @else
                            <span class="text-blue-600 font-bold">No</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($material->fecha_vencimiento)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">{{ $material->tipoMaterial ? $material->tipoMaterial->nombre_tipo_material : 'Sin tipo' }}</td>
                    <td class="px-4 py-2">
                        @if($material->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('materiales.edit', $material->id_material) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center py-4">No hay materiales registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 