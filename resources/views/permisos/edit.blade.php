@extends('layouts.app')

@section('title', 'Editar Permiso | BoxWare')

@section('content')
<<<<<<< HEAD
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Editar Permiso</h2>
    <form method="POST" action="#">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="nombre" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="mb-4 grid grid-cols-3 gap-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Puede ver</label>
                <select name="puede_ver" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Puede crear</label>
                <select name="puede_crear" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Puede editar</label>
                <select name="puede_editar" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Módulo</label>
            <select name="modulo_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Selecciona un módulo</option>
                @foreach($modulos as $modulo)
                    <option value="{{ $modulo->id_modulo }}" {{ (old('modulo_id', $permiso->modulo_id) == $modulo->id_modulo) ? 'selected' : '' }}>{{ $modulo->descripcion_ruta }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Rol</label>
            <select name="rol_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Selecciona un rol</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->id_rol }}" {{ (old('rol_id', $permiso->rol_id) == $rol->id_rol) ? 'selected' : '' }}>{{ $rol->nombre_rol }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('permisos.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection 
=======
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Editar Permiso</h1>
        <p class="text-primary-300">Actualiza la información del permiso en el sistema BoxWare</p>
    </div>
    <a href="{{ route('permisos.index') }}" 
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
                    <i class="fas fa-key text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Información del Permiso</h3>
                    <p class="text-primary-300 text-sm">Actualiza los campos que deseas modificar</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form method="POST" action="{{ route('permisos.update', $permiso->id_permiso) }}" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Basic Information Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-info-circle text-white text-sm"></i>
                        </div>
                        Información Básica
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-signature mr-2 text-accent-500"></i>
                                    Nombre
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="nombre" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa el nombre del permiso"
                                   value="{{ old('nombre', $permiso->nombre) }}" required>
                            @error('nombre')
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
                                <option value="1" class="bg-primary-800" {{ old('estado', $permiso->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" class="bg-primary-800" {{ old('estado', $permiso->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Permissions Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-lock text-white text-sm"></i>
                        </div>
                        Acciones Permitidas
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-eye mr-2 text-accent-500"></i>
                                    Puede ver
                                </span>
                            </label>
                            <select name="puede_ver" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                                <option value="1" class="bg-primary-800" {{ old('puede_ver', $permiso->puede_ver) == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" class="bg-primary-800" {{ old('puede_ver', $permiso->puede_ver) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('puede_ver')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-plus-circle mr-2 text-accent-500"></i>
                                    Puede crear
                                </span>
                            </label>
                            <select name="puede_crear" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                                <option value="1" class="bg-primary-800" {{ old('puede_crear', $permiso->puede_crear) == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" class="bg-primary-800" {{ old('puede_crear', $permiso->puede_crear) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('puede_crear')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-edit mr-2 text-accent-500"></i>
                                    Puede editar
                                </span>
                            </label>
                            <select name="puede_editar" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                                <option value="1" class="bg-primary-800" {{ old('puede_editar', $permiso->puede_editar) == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" class="bg-primary-800" {{ old('puede_editar', $permiso->puede_editar) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('puede_editar')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Associations Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-link text-white text-sm"></i>
                        </div>
                        Asociaciones
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-puzzle-piece mr-2 text-accent-500"></i>
                                    Módulo
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="modulo_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                <option value="" class="bg-primary-800">Selecciona un módulo</option>
                                @foreach($modulos as $modulo)
                                    <option value="{{ $modulo->id_modulo }}" class="bg-primary-800" {{ old('modulo_id', $permiso->modulo_id) == $modulo->id_modulo ? 'selected' : '' }}>
                                        {{ $modulo->descripcion_ruta }}
                                    </option>
                                @endforeach
                            </select>
                            @error('modulo_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-user-tag mr-2 text-accent-500"></i>
                                    Rol
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="rol_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                <option value="" class="bg-primary-800">Selecciona un rol</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id_rol }}" class="bg-primary-800" {{ old('rol_id', $permiso->rol_id) == $rol->id_rol ? 'selected' : '' }}>
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
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="border-t border-primary-700 pt-6 flex justify-end">
                    <a href="{{ route('permisos.index') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center mr-4">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" class="bg-accent-600 hover:bg-accent-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Actualizar Permiso
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
