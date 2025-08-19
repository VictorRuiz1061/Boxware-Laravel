@extends('layouts.app')

@section('title', 'Áreas | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Gestión de Áreas</h1>
        <p class="text-primary-300">Administra las áreas del sistema BoxWare</p>
    </div>
    <a href="{{ route('areas.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-plus-circle text-sm"></i>
        <span>Crear Área</span>
    </a>
</div>

<!-- Table Container -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-building text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Lista de Áreas</h3>
                <p class="text-primary-300 text-sm">{{ count($areas) }} áreas encontradas</p>
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
                        <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">Sede</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-primary-700">
                    @forelse($areas as $area)
                        <tr class="hover:bg-primary-800 hover:bg-opacity-30 transition-colors duration-150">
                            <td class="px-6 py-4 text-white">{{ $area->id_area }}</td>
                            <td class="px-6 py-4 text-white">
                                <div class="flex items-center">
                                    <i class="fas fa-building text-accent-500 mr-2"></i>
                                    <span>{{ $area->nombre_area }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-primary-200">{{ $area->sede->nombre_sede ?? 'No asignada' }}</td>
                            <td class="px-6 py-4">
                                @if($area->estado)
                                    <span class="px-3 py-1 bg-green-900 bg-opacity-30 text-green-400 rounded-full text-xs font-medium flex items-center w-fit">
                                        <i class="fas fa-check-circle mr-1"></i> Activo
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-900 bg-opacity-30 text-red-400 rounded-full text-xs font-medium flex items-center w-fit">
                                        <i class="fas fa-times-circle mr-1"></i> Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('areas.edit', $area->id_area) }}" 
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
                                    <p class="text-lg">No hay áreas registradas.</p>
                                    <p class="text-sm text-primary-400 mt-1">Crea una nueva área para comenzar.</p>
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