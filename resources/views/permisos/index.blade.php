@extends('layouts.app')

@section('title', 'Permisos | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Permisos</h2>
    <a href="{{ route('permisos.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Permiso</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Nombre</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Ver</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Crear</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Editar</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">modulo</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">roles</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($permisos as $permiso)
                <tr>
                    <td class="px-4 py-2">{{ $permiso->id_permiso }}</td>
                    <td class="px-4 py-2">{{ $permiso->nombre }}</td>
                    <td class="px-4 py-2">
                        @if($permiso->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $permiso->puede_ver ? 'Sí' : 'No' }}</td>
                    <td class="px-4 py-2">{{ $permiso->puede_crear ? 'Sí' : 'No' }}</td>
                    <td class="px-4 py-2">{{ $permiso->puede_editar ? 'Sí' : 'No' }}</td>
                    <td class="px-4 py-2">{{ $permiso->modulo ? $permiso->modulo->descripcion_ruta : 'Sin modulo' }}</td>
                    <td class="px-4 py-2">{{ $permiso->rol ? $permiso->rol->nombre_rol : 'Sin rol' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('permisos.edit', $permiso->id_permiso) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4">No hay permisos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 