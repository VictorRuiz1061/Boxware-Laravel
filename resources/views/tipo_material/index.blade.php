@extends('layouts.app')

@section('title', 'Tipos de Material | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-white">Tipos de Material</h2>
    <a href="{{ route('tipo_material.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Tipo de Material</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Tipo de Elemento</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Fecha Creación</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tiposMaterial as $tipoMaterial)
                <tr>
                    <td class="px-4 py-2">{{ $tipoMaterial->id_tipo_material }}</td>
                    <td class="px-4 py-2">{{ $tipoMaterial->tipo_elemento }}</td>
                    <td class="px-4 py-2">
                        @if($tipoMaterial->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($tipoMaterial->fecha_creacion)->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('tipo_material.edit', $tipoMaterial->id_tipo_material) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No hay tipos de material registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 