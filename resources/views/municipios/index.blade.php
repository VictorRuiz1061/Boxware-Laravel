@extends('layouts.app')

@section('title', 'Municipios | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Municipios</h2>
    <a href="{{ route('municipios.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Municipio</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Nombre del Municipio</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Fecha de Creación</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Fecha de Modificación</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($municipios as $municipio)
                <tr>
                    <td class="px-4 py-2">{{ $municipio->id_municipio }}</td>
                    <td class="px-4 py-2">{{ $municipio->nombre_municipio }}</td>
                    <td class="px-4 py-2">{{ $municipio->fecha_creacion }}</td>
                    <td class="px-4 py-2">{{ $municipio->fecha_modificacion }}</td>
                    <td class="px-4 py-2">
                        @if($municipio->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('municipios.edit', $municipio->id_municipio) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No hay municipios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
