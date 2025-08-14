@extends('layouts.app')

@section('title', 'Inventario | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Inventario</h1>
        <p class="text-primary-300">Administra el inventario del sistema BoxWare</p>
    </div>
    <a href="{{ route('inventario.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-plus text-sm"></i>
        <span>Nuevo Elemento</span>
    </a>
</div>

<!-- Filtros Section -->
<!-- <div class="glass-effect rounded-xl border border-primary-700 overflow-hidden mb-8">
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-filter text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Filtros</h3>
                <p class="text-primary-300 text-sm">Filtra el inventario por sitio o material</p>
            </div>
        </div>
    </div>
    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <a href="{{ route('inventario.por_sitio') }}" 
               class="w-full bg-primary-700 hover:bg-primary-600 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center space-x-3">
                <i class="fas fa-map-marker-alt text-accent-500 text-lg"></i>
                <span>Ver por Sitio</span>
            </a>
        </div>
        <div>
            <a href="{{ route('inventario.por_material') }}" 
               class="w-full bg-primary-700 hover:bg-primary-600 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center space-x-3">
                <i class="fas fa-boxes text-accent-500 text-lg"></i>
                <span>Ver por Material</span>
            </a>
        </div>
    </div>
</div> -->

<!-- Content Section -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-warehouse text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Lista de Inventario</h3>
                <p class="text-primary-300 text-sm">{{ count($inventario) }} elementos encontrados</p>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-primary-300 border-b border-primary-700">
                        <th class="pb-4 font-semibold">ID</th>
                        <th class="pb-4 font-semibold">Material</th>
                        <th class="pb-4 font-semibold">Sitio</th>
                        <th class="pb-4 font-semibold">Stock</th>
                        <th class="pb-4 font-semibold">Placa SENA</th>
                        <th class="pb-4 font-semibold">Descripción</th>
                        <th class="pb-4 font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inventario as $item)
                        <tr class="border-b border-primary-700 hover:bg-primary-800 hover:bg-opacity-50 transition-colors duration-200">
                            <td class="py-4 text-white">{{ $item->id_inventario }}</td>
                            <td class="py-4 text-white">{{ $item->material->nombre_material }}</td>
                            <td class="py-4 text-white">{{ $item->sitio->nombre_sitio }}</td>
                            <td class="py-4 text-white">{{ $item->stock }}</td>
                            <td class="py-4 text-white">{{ $item->placa_sena }}</td>
                            <td class="py-4 text-white">{{ Str::limit($item->descripcion, 30) }}</td>
                            <td class="py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('inventario.edit', $item->id_inventario) }}" 
                                       class="p-2 bg-primary-700 hover:bg-primary-600 rounded-lg text-primary-300 hover:text-white transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-primary-300">
                                <div class="flex flex-col items-center justify-center space-y-4">
                                    <div class="w-16 h-16 bg-primary-800 rounded-full flex items-center justify-center">
                                        <i class="fas fa-warehouse text-primary-600 text-2xl"></i>
                                    </div>
                                    <p>No hay elementos en el inventario</p>
                                    <a href="{{ route('inventario.create') }}" class="text-accent-500 hover:text-accent-400 transition-colors duration-200">
                                        Crear un nuevo elemento de inventario
                                    </a>
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