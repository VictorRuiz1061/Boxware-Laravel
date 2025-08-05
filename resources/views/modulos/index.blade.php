@extends('layouts.app')

@section('title', 'Módulos | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-white">Módulos</h2>
    <a href="{{ route('modulos.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Módulo</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Ruta</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Descripción</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">¿Submenú?</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($modulos as $modulo)
                <tr>
                    <td class="px-4 py-2">{{ $modulo->id_modulo }}</td>
                    <td class="px-4 py-2">{{ $modulo->rutas }}</td>
                    <td class="px-4 py-2">{{ $modulo->descripcion_ruta }}</td>
                    <td class="px-4 py-2">
                        @if($modulo->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $modulo->es_submenu ? 'Sí' : 'No' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('modulos.edit', $modulo->id_modulo) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No hay módulos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 