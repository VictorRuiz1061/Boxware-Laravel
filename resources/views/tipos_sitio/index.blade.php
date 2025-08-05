@extends('layouts.app')

@section('title', 'Tipos de Sitio | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Tipos de Sitio</h2>
    <a href="{{ route('tipos_sitio.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Tipo de Sitio</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Nombre</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tiposSitio as $tipoSitio)
                <tr>
                    <td class="px-4 py-2">{{ $tipoSitio->id_tipo_sitio }}</td>
                    <td class="px-4 py-2">{{ $tipoSitio->nombre_tipo_sitio }}</td>
                    <td class="px-4 py-2">
                        @if($tipoSitio->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('tipos_sitio.edit', $tipoSitio->id_tipo_sitio) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No hay tipos de sitio registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 