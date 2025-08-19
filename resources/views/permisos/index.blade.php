@extends('layouts.app')

@section('title', 'Permisos | BoxWare')

@section('content')
<<<<<<< HEAD
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
=======
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Permisos</h1>
        <p class="text-primary-300">Gestiona los permisos del sistema BoxWare</p>
    </div>
    <a href="{{ route('permisos.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-plus-circle text-sm"></i>
        <span>Crear Permiso</span>
    </a>
</div>

<!-- Table Container -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-key text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Lista de Permisos</h3>
                <p class="text-primary-300 text-sm">Visualiza y gestiona los permisos del sistema</p>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-primary-700">
                <thead>
                    <tr class="bg-primary-800 bg-opacity-50">
                        <th class="px-4 py-3 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                            <span class="flex items-center">
                                <i class="fas fa-hashtag mr-2 text-accent-500"></i>
                                ID
                            </span>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                            <span class="flex items-center">
                                <i class="fas fa-signature mr-2 text-accent-500"></i>
                                Nombre
                            </span>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                            <span class="flex items-center">
                                <i class="fas fa-toggle-on mr-2 text-accent-500"></i>
                                Estado
                            </span>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                            <span class="flex items-center">
                                <i class="fas fa-eye mr-2 text-accent-500"></i>
                                Ver
                            </span>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                            <span class="flex items-center">
                                <i class="fas fa-plus-circle mr-2 text-accent-500"></i>
                                Crear
                            </span>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                            <span class="flex items-center">
                                <i class="fas fa-edit mr-2 text-accent-500"></i>
                                Editar
                            </span>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                            <span class="flex items-center">
                                <i class="fas fa-puzzle-piece mr-2 text-accent-500"></i>
                                Módulo
                            </span>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                            <span class="flex items-center">
                                <i class="fas fa-user-tag mr-2 text-accent-500"></i>
                                Rol
                            </span>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-primary-300 uppercase tracking-wider">
                            <span class="flex items-center">
                                <i class="fas fa-cogs mr-2 text-accent-500"></i>
                                Acciones
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-primary-700">
                    @forelse($permisos as $permiso)
                        <tr class="hover:bg-primary-800 hover:bg-opacity-50 transition-colors duration-150">
                            <td class="px-4 py-3 text-sm text-white">{{ $permiso->id_permiso }}</td>
                            <td class="px-4 py-3 text-sm text-white">
                                <span class="flex items-center">
                                    <i class="fas fa-key text-accent-500 mr-2"></i>
                                    {{ $permiso->nombre }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if($permiso->estado)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-white">
                                @if($permiso->puede_ver)
                                    <span class="text-green-400"><i class="fas fa-check-circle"></i> Sí</span>
                                @else
                                    <span class="text-red-400"><i class="fas fa-times-circle"></i> No</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-white">
                                @if($permiso->puede_crear)
                                    <span class="text-green-400"><i class="fas fa-check-circle"></i> Sí</span>
                                @else
                                    <span class="text-red-400"><i class="fas fa-times-circle"></i> No</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-white">
                                @if($permiso->puede_editar)
                                    <span class="text-green-400"><i class="fas fa-check-circle"></i> Sí</span>
                                @else
                                    <span class="text-red-400"><i class="fas fa-times-circle"></i> No</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-white">
                                <span class="flex items-center">
                                    <i class="fas fa-puzzle-piece text-primary-400 mr-2"></i>
                                    {{ $permiso->modulo ? $permiso->modulo->descripcion_ruta : 'Sin módulo' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-white">
                                <span class="flex items-center">
                                    <i class="fas fa-user-tag text-primary-400 mr-2"></i>
                                    {{ $permiso->rol ? $permiso->rol->nombre_rol : 'Sin rol' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-white">
                                <a href="{{ route('permisos.edit', $permiso->id_permiso) }}" 
                                   class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors duration-150">
                                    <i class="fas fa-edit mr-1"></i> Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-primary-800 bg-opacity-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-folder-open text-primary-400 text-2xl"></i>
                                    </div>
                                    <p class="text-primary-300 font-medium">No hay permisos registrados.</p>
                                    <a href="{{ route('permisos.create') }}" class="mt-3 text-accent-500 hover:text-accent-400 font-medium flex items-center">
                                        <i class="fas fa-plus-circle mr-2"></i> Crear nuevo permiso
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
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
