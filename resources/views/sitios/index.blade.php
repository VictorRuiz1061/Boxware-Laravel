@extends('layouts.app')

@section('title', 'Sitios | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-white">Sitios</h2>
    <a href="{{ route('sitios.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Sitio</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Nombre</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Ubicación</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Ficha Técnica</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Tipo de Sitio</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sitios as $sitio)
                <tr>
                    <td class="px-4 py-2">{{ $sitio->id_sitio }}</td>
                    <td class="px-4 py-2">{{ $sitio->nombre_sitio }}</td>
                    <td class="px-4 py-2">{{ $sitio->ubicacion }}</td>
                    <td class="px-4 py-2">{{ $sitio->ficha_tecnica }}</td>
                    <td class="px-4 py-2">{{ $sitio->tipoSitio->nombre_tipo_sitio ?? 'No asignado' }}</td>
                    <td class="px-4 py-2">
                        @if($sitio->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('sitios.edit', $sitio->id_sitio) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No hay sitios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
