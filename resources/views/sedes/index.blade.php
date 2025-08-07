@extends('layouts.app')

@section('title', 'Sedes | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Sedes</h2>
    <a href="{{ route('sedes.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Sede</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Nombre de la Sede</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Dirección de la Sede</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Fecha de Creación</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Fecha de Modificación</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Centro</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sedes as $sede)
                <tr>
                    <td class="px-4 py-2">{{ $sede->id_sede }}</td>
                    <td class="px-4 py-2">{{ $sede->nombre_sede }}</td>
                    <td class="px-4 py-2">{{ $sede->direccion_sede }}</td>
                    <td class="px-4 py-2">{{ $sede->fecha_creacion }}</td>
                    <td class="px-4 py-2">{{ $sede->fecha_modificacion }}</td>
                    <td class="px-4 py-2">{{ $sede->centro_id }}</td>
                    <td class="px-4 py-2">
                        @if($sede->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('sedes.edit', $sede->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4">No hay sedes registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
