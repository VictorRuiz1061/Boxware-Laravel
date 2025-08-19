@extends('layouts.app')

@section('title', 'Módulos | BoxWare')

@section('content')
<<<<<<< HEAD
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Módulos</h2>
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
=======
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Módulos</h1>
        <p class="text-primary-300">Gestiona los módulos del sistema BoxWare</p>
    </div>
    <a href="{{ route('modulos.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-plus text-sm"></i>
        <span>Crear Módulo</span>
    </a>
</div>

<!-- Table Container -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-puzzle-piece text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Lista de Módulos</h3>
                <p class="text-primary-300 text-sm">Visualiza y administra los módulos del sistema</p>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="p-6">
        <table class="min-w-full divide-y divide-primary-700">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-hashtag text-accent-500"></i>
                            <span>ID</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-route text-accent-500"></i>
                            <span>Ruta</span>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-tag text-accent-500"></i>
                            <span>Descripción</span>
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
                            <i class="fas fa-sitemap text-accent-500"></i>
                            <span>¿Submenú?</span>
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
                @forelse($modulos as $modulo)
                    <tr class="hover:bg-primary-800 hover:bg-opacity-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            <div class="flex items-center">
                                <span class="bg-primary-700 text-primary-300 text-xs rounded-full w-8 h-8 flex items-center justify-center">
                                    {{ $modulo->id_modulo }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            <div class="flex items-center">
                                <i class="fas fa-link text-primary-400 mr-2"></i>
                                <span>{{ $modulo->rutas }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt text-primary-400 mr-2"></i>
                                <span>{{ $modulo->descripcion_ruta }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($modulo->estado)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Activo
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Inactivo
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-white">
                            @if($modulo->es_submenu)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-check mr-1"></i> Sí
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    <i class="fas fa-minus mr-1"></i> No
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('modulos.edit', $modulo->id_modulo) }}" 
                               class="text-yellow-500 hover:text-yellow-400 mr-3 transition-colors duration-200">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-primary-800 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-puzzle-piece text-primary-400 text-2xl"></i>
                                </div>
                                <p class="text-primary-300 text-lg mb-2">No hay módulos registrados</p>
                                <a href="{{ route('modulos.create') }}" class="text-accent-500 hover:text-accent-400 font-semibold flex items-center">
                                    <i class="fas fa-plus mr-2"></i>
                                    Crear un nuevo módulo
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
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
