@extends('layouts.app')

@section('title', 'Categorías de Elemento | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-white">Categorías de Elemento</h2>
    <a href="{{ route('categorias_elementos.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Categoría</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Código QNPSC</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Nombre</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categorias as $categoria)
                <tr>
                    <td class="px-4 py-2">{{ $categoria->id_categoria_elemento }}</td>
                    <td class="px-4 py-2">{{ $categoria->codigo_qnpsc }}</td>
                    <td class="px-4 py-2">{{ $categoria->nombre_categoria }}</td>
                    <td class="px-4 py-2">
                        @if($categoria->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('categorias_elementos.edit', $categoria->id_categoria_elemento) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No hay categorías registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 