@extends('layouts.app')

<<<<<<< HEAD
@section('title', 'Categorías de Elemento | BoxWare')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Categorías de Elemento</h2>
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
=======
@section('title', 'Categorías de Elementos | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Gestión de Categorías</h1>
        <p class="text-primary-300">Administra las categorías de elementos del sistema BoxWare</p>
    </div>
    <a href="{{ route('categorias_elementos.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-plus-circle text-sm"></i>
        <span>Crear Categoría</span>
    </a>
</div>

<!-- Table Container -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-tags text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Lista de Categorías</h3>
                <p class="text-primary-300 text-sm">{{ count($categorias) }} categorías encontradas</p>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-primary-700">
                <thead>
                    <tr class="bg-primary-800 bg-opacity-40">
                        <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">Código QNPSC</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-primary-700">
                    @forelse($categorias as $categoria)
                        <tr class="hover:bg-primary-800 hover:bg-opacity-30 transition-colors duration-150">
                            <td class="px-6 py-4 text-white">{{ $categoria->id_categoria_elemento }}</td>
                            <td class="px-6 py-4 text-white">{{ $categoria->codigo_qnpsc }}</td>
                            <td class="px-6 py-4 text-white">{{ $categoria->nombre_categoria }}</td>
                            <td class="px-6 py-4">
                                @if($categoria->estado)
                                    <span class="px-3 py-1 bg-green-900 bg-opacity-30 text-green-400 rounded-full text-xs font-medium flex items-center w-fit">
                                        <i class="fas fa-check-circle mr-1"></i> Activa
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-900 bg-opacity-30 text-red-400 rounded-full text-xs font-medium flex items-center w-fit">
                                        <i class="fas fa-times-circle mr-1"></i> Inactiva
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('categorias_elementos.edit', $categoria->id_categoria_elemento) }}" 
                                       class="bg-primary-600 hover:bg-primary-700 text-white px-3 py-1.5 rounded-lg font-medium transition-colors duration-200 flex items-center">
                                        <i class="fas fa-edit mr-1.5"></i>
                                        <span>Editar</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-primary-300">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-folder-open text-4xl mb-3 text-primary-600"></i>
                                    <p class="text-lg">No hay categorías registradas.</p>
                                    <p class="text-sm text-primary-400 mt-1">Crea una nueva categoría para comenzar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
