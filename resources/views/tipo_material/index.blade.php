@extends('layouts.app')

@section('title', 'Tipos de Material | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Tipos de Material</h1>
        <p class="text-primary-300">Administra los tipos de material del sistema BoxWare</p>
    </div>
    <a href="{{ route('tipo_material.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-plus text-sm"></i>
        <span>Nuevo Tipo de Material</span>
    </a>
</div>

<!-- Content Section -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-boxes text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Lista de Tipos de Material</h3>
                <p class="text-primary-300 text-sm">{{ count($tiposMaterial) }} tipos de material encontrados</p>
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
                        <th class="pb-4 font-semibold">Tipo de Elemento</th>
                        <th class="pb-4 font-semibold">Estado</th>
                        <th class="pb-4 font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tiposMaterial as $tipoMaterial)
                        <tr class="border-b border-primary-700 hover:bg-primary-800 hover:bg-opacity-50 transition-colors duration-200">
                            <td class="py-4 text-white">{{ $tipoMaterial->id_tipo_material }}</td>
                            <td class="py-4 text-white">{{ $tipoMaterial->tipo_elemento }}</td>
                            <td class="py-4">
                                @if ($tipoMaterial->estado)
                                    <span class="px-3 py-1 bg-green-500 bg-opacity-20 text-green-500 rounded-full text-xs font-semibold">
                                        Activo
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-500 bg-opacity-20 text-red-500 rounded-full text-xs font-semibold">
                                        Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('tipo_material.edit', $tipoMaterial->id_tipo_material) }}" 
                                       class="p-2 bg-primary-700 hover:bg-primary-600 rounded-lg text-primary-300 hover:text-white transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-primary-300">
                                <div class="flex flex-col items-center justify-center space-y-4">
                                    <div class="w-16 h-16 bg-primary-800 rounded-full flex items-center justify-center">
                                        <i class="fas fa-boxes text-primary-600 text-2xl"></i>
                                    </div>
                                    <p>No hay tipos de material registrados</p>
                                    <a href="{{ route('tipo_material.create') }}" class="text-accent-500 hover:text-accent-400 transition-colors duration-200">
                                        Crear un nuevo tipo de material
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