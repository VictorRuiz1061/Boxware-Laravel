@extends('layouts.app')

@section('title', 'Roles | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-white">Roles</h2>
    <a href="{{ route('roles.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Rol</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Nombre</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Descripción</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $rol)
                <tr>
                    <td class="px-4 py-2">{{ $rol->id_rol }}</td>
                    <td class="px-4 py-2">{{ $rol->nombre_rol }}</td>
                    <td class="px-4 py-2">{{ $rol->descripcion }}</td>
                    <td class="px-4 py-2">
                        @if($rol->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('roles.edit', $rol->id_rol) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No hay roles registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 