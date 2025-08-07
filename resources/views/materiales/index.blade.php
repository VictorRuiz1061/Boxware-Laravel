@extends('layouts.app')

@section('title', 'Materiales | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Materiales</h1>
        <p class="text-primary-300">Gestiona los materiales del sistema BoxWare</p>
    </div>
    <a href="{{ route('materiales.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-plus text-sm"></i>
        <span>Crear Material</span>
    </a>
</div>

<!-- Table Container -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-boxes text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Lista de Materiales</h3>
                <p class="text-primary-300 text-sm">Visualiza y administra los materiales del sistema</p>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="p-6 overflow-x-auto">
        <table class="min-w-full divide-y divide-primary-700">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-barcode text-accent-500"></i>
                            <span>Código SENA</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-tag text-accent-500"></i>
                            <span>Nombre</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-align-left text-accent-500"></i>
                            <span>Descripción</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-ruler text-accent-500"></i>
                            <span>Unidad</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-apple-alt text-accent-500"></i>
                            <span>Perecedero</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar-alt text-accent-500"></i>
                            <span>Vencimiento</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-layer-group text-accent-500"></i>
                            <span>Tipo</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-toggle-on text-accent-500"></i>
                            <span>Estado</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-cogs text-accent-500"></i>
                            <span>Acciones</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-700">
                @forelse($materiales as $material)
                    <tr class="hover:bg-primary-800 hover:bg-opacity-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            <div class="flex items-center">
                                <i class="fas fa-barcode text-primary-400 mr-2"></i>
                                <span>{{ $material->codigo_sena }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            <div class="flex items-center">
                                <i class="fas fa-box text-primary-400 mr-2"></i>
                                <span>{{ $material->nombre_material }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt text-primary-400 mr-2"></i>
                                <span>{{ Str::limit($material->descripcion_material, 50) }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            <div class="flex items-center">
                                <i class="fas fa-ruler-combined text-primary-400 mr-2"></i>
                                <span>{{ $material->unidad_medida }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($material->producto_peresedero)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                    <i class="fas fa-check-circle mr-1"></i> Sí
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-times-circle mr-1"></i> No
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-primary-400 mr-2"></i>
                                <span>{{ \Carbon\Carbon::parse($material->fecha_vencimiento)->format('d/m/Y') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            <div class="flex items-center">
                                <i class="fas fa-layer-group text-primary-400 mr-2"></i>
                                <span>{{ $material->tipoMaterial ? $material->tipoMaterial->nombre_tipo_material : 'Sin tipo' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($material->estado)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Activo
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Inactivo
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('materiales.edit', $material->id_material) }}" 
                               class="text-yellow-500 hover:text-yellow-400 transition-colors duration-200">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-6 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-primary-800 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-boxes text-primary-400 text-2xl"></i>
                                </div>
                                <p class="text-primary-300 text-lg mb-2">No hay materiales registrados</p>
                                <a href="{{ route('materiales.create') }}" class="text-accent-500 hover:text-accent-400 font-semibold flex items-center">
                                    <i class="fas fa-plus mr-2"></i>
                                    Crear un nuevo material
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection