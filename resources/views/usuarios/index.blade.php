@extends('layouts.app')

@section('title', 'Usuarios | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Gestión de Usuarios</h1>
        <p class="text-primary-300">Administra los usuarios del sistema BoxWare</p>
    </div>
    <a href="{{ route('usuarios.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
        <i class="fas fa-plus text-sm"></i>
        <span>Crear Usuario</span>
    </a>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="glass-effect rounded-xl p-6 border border-primary-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-primary-300 text-sm font-medium">Total Usuarios</p>
                <p class="text-2xl font-bold text-white">{{ $usuarios->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-users text-white"></i>
            </div>
        </div>
    </div>
    <div class="glass-effect rounded-xl p-6 border border-primary-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-primary-300 text-sm font-medium">Usuarios Activos</p>
                <p class="text-2xl font-bold text-green-400">{{ $usuarios->where('estado', 1)->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-check text-white"></i>
            </div>
        </div>
    </div>
    <div class="glass-effect rounded-xl p-6 border border-primary-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-primary-300 text-sm font-medium">Usuarios Inactivos</p>
                <p class="text-2xl font-bold text-red-400">{{ $usuarios->where('estado', 0)->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-times text-white"></i>
            </div>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-6 py-4 border-b border-primary-700">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-white">Lista de Usuarios</h3>
            <div class="flex items-center space-x-3">
                <!-- Search Input -->
                <div class="relative">
                    <input type="text" placeholder="Buscar usuarios..." 
                           class="bg-primary-700 border border-primary-600 text-white placeholder-primary-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                    <i class="fas fa-search absolute right-3 top-3 text-primary-300"></i>
                </div>
                <!-- Filter Dropdown -->
                <select class="bg-primary-700 border border-primary-600 text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                    <option value="">Todos los estados</option>
                    <option value="1">Activos</option>
                    <option value="0">Inactivos</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-primary-700">
            <thead class="bg-primary-800 bg-opacity-30">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-200 uppercase tracking-wider">
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-200 uppercase tracking-wider">Usuario</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-200 uppercase tracking-wider">Contacto</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-200 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-200 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-primary-200 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-700">
                @forelse($usuarios as $usuario)
                    <tr class="hover:bg-primary-800 hover:bg-opacity-30 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($usuario->imagen)
                                <div class="w-10 h-10 rounded-lg mr-3 overflow-hidden">
                                    <img src="{{ asset('storage/' . $usuario->imagen) }}" alt="{{ $usuario->nombre }}" class="w-full h-full object-cover">
                                </div>
                                @else
                                <div class="w-10 h-10 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <div class="text-white font-semibold">{{ $usuario->nombre }} {{ $usuario->apellido }}</div>
                                <div class="text-primary-300 text-sm">{{ $usuario->cedula }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <div class="text-white text-sm">{{ $usuario->email }}</div>
                                <div class="text-primary-300 text-sm">{{ $usuario->telefono ?? 'N/A' }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($usuario->rol)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-600 bg-opacity-20 text-purple-300 border border-purple-600 border-opacity-30">
                                    <i class="fas fa-user-shield mr-2"></i>
                                    {{ $usuario->rol->nombre_rol }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-600 bg-opacity-20 text-gray-400 border border-gray-600 border-opacity-30">
                                    Sin rol asignado
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($usuario->estado)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-600 bg-opacity-20 text-green-300 border border-green-600 border-opacity-30">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    Activo
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-600 bg-opacity-20 text-red-300 border border-red-600 border-opacity-30">
                                    <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                    Inactivo
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center space-x-2">
                                <!-- View Button -->
                                <button class="flex items-center justify-center w-8 h-8 bg-blue-600 bg-opacity-20 hover:bg-opacity-30 text-blue-400 rounded-lg transition-colors duration-200 group">
                                    <i class="fas fa-eye text-xs group-hover:scale-110 transition-transform duration-200"></i>
                                </button>
                                <!-- Edit Button -->
                                <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" 
                                   class="flex items-center justify-center w-8 h-8 bg-yellow-600 bg-opacity-20 hover:bg-opacity-30 text-yellow-400 rounded-lg transition-colors duration-200 group">
                                    <i class="fas fa-edit text-xs group-hover:scale-110 transition-transform duration-200"></i>
                                </a>
                                <!-- Delete Button -->
                                <button class="flex items-center justify-center w-8 h-8 bg-red-600 bg-opacity-20 hover:bg-opacity-30 text-red-400 rounded-lg transition-colors duration-200 group">
                                    <i class="fas fa-trash text-xs group-hover:scale-110 transition-transform duration-200"></i>
                                </button>
                                <!-- More Options -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center justify-center w-8 h-8 bg-primary-600 bg-opacity-20 hover:bg-opacity-30 text-primary-400 rounded-lg transition-colors duration-200 group">
                                        <i class="fas fa-ellipsis-v text-xs group-hover:scale-110 transition-transform duration-200"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" 
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         class="absolute right-0 mt-2 w-48 glass-effect rounded-lg shadow-lg z-10 border border-primary-700">
                                        <a href="#" class="block px-4 py-2 text-sm text-primary-200 hover:bg-primary-700 transition-colors duration-200">
                                            <i class="fas fa-key mr-2"></i>Cambiar contraseña
                                        </a>
                                        <a href="#" class="block px-4 py-2 text-sm text-primary-200 hover:bg-primary-700 transition-colors duration-200">
                                            <i class="fas fa-history mr-2"></i>Ver historial
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-primary-700 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-users text-primary-300 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-white mb-2">No hay usuarios registrados</h3>
                                <p class="text-primary-300 mb-4">Comienza agregando tu primer usuario al sistema</p>
                                <a href="{{ route('usuarios.create') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-accent-600 hover:bg-accent-700 text-white rounded-lg font-semibold transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i>Crear Usuario
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Table Footer / Pagination -->
    <div class="bg-primary-800 bg-opacity-30 px-6 py-4 border-t border-primary-700">
        <div class="flex items-center justify-between">
            <div class="text-sm text-primary-300">
                Mostrando {{ $usuarios->count() }} usuarios
            </div>
            <div class="flex items-center space-x-2">
                <!-- Pagination would go here -->
                <button class="px-3 py-2 text-primary-300 hover:text-white hover:bg-primary-700 rounded-lg transition-colors duration-200">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span class="px-4 py-2 bg-accent-600 text-white rounded-lg font-semibold">1</span>
                <button class="px-3 py-2 text-primary-300 hover:text-white hover:bg-primary-700 rounded-lg transition-colors duration-200">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection