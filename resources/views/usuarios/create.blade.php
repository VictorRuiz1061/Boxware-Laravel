@extends('layouts.app')

@section('title', 'Crear Usuario | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Crear Nuevo Usuario</h1>
        <p class="text-primary-300">Agrega un nuevo usuario al sistema BoxWare</p>
    </div>
    <a href="{{ route('usuarios.index') }}" 
       class="flex items-center space-x-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-arrow-left text-sm"></i>
        <span>Volver</span>
    </a>
</div>

<div class="max-w-4xl mx-auto">
    <div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
        <!-- Form Header -->
        <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-plus text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Información del Usuario</h3>
                    <p class="text-primary-300 text-sm">Completa todos los campos requeridos</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-8">
                @csrf

                <!-- Personal Information Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        Información Personal
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-id-card mr-2 text-accent-500"></i>
                                    Nombre
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="nombre" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa el nombre"
                                   value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-id-card mr-2 text-accent-500"></i>
                                    Apellido
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="apellido" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa el apellido"
                                   value="{{ old('apellido') }}" required>
                            @error('apellido')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-id-badge mr-2 text-accent-500"></i>
                                    Cédula
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="cedula" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa la cédula"
                                   value="{{ old('cedula') }}" required>
                            @error('cedula')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-birthday-cake mr-2 text-accent-500"></i>
                                    Edad
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="number" name="edad" min="18" max="100"
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa la edad"
                                   value="{{ old('edad') }}" required>
                            @error('edad')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="border-t border-primary-700 pt-8">
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-envelope text-white text-sm"></i>
                        </div>
                        Información de Contacto
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-envelope mr-2 text-accent-500"></i>
                                    Email
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="email" name="email" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="correo@ejemplo.com"
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-phone mr-2 text-accent-500"></i>
                                    Teléfono
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="telefono" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa el teléfono"
                                   value="{{ old('telefono') }}" required>
                            @error('telefono')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Access Information Section -->
                <div class="border-t border-primary-700 pt-8">
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-key text-white text-sm"></i>
                        </div>
                        Información de Acceso
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-lock mr-2 text-accent-500"></i>
                                    Contraseña
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password" 
                                       class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                       placeholder="Ingresa una contraseña segura" required>
                                <button type="button" class="absolute right-3 top-3 text-primary-400 hover:text-white transition-colors duration-200">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <p class="mt-2 text-primary-300 text-sm flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                La contraseña debe tener al menos 8 caracteres
                            </p>
                            @error('password')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-user-shield mr-2 text-accent-500"></i>
                                    Rol
                                </span>
                            </label>
                            <select name="rol_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                                <option value="" class="bg-primary-800">Selecciona un rol</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id_rol }}" class="bg-primary-800" {{ old('rol_id') == $rol->id_rol ? 'selected' : '' }}>
                                        {{ $rol->nombre_rol }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rol_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-toggle-on mr-2 text-accent-500"></i>
                                    Estado
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="estado" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                <option value="1" class="bg