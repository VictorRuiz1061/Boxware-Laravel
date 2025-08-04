@extends('layouts.app')

@section('title', 'Fichas | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Fichas</h2>
    <a href="{{ route('fichas.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Ficha</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Nombre</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">programa_id</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">usuario_id</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fichas as $ficha)
                <tr>
                    <td class="px-4 py-2">{{ $ficha->id_ficha }}</td>
                    <td class="px-4 py-2">{{ $ficha->nombre_ficha }}</td>
                    <td class="px-4 py-2">{{ $ficha->programa_id }}</td>
                    <td class="px-4 py-2">{{ $ficha->usuario_id }}</td>
                    <td class="px-4 py-2">
                        @if($ficha->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('fichas.edit', $ficha->id_ficha) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No hay fichas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 