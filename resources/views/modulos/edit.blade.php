@extends('layouts.app')

@section('title', 'Editar Módulo | BoxWare')

@section('content')
<<<<<<< HEAD
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Editar Módulo</h2>
    <form method="POST" action="#">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Ruta</label>
            <input type="text" name="rutas" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <input type="text" name="descripcion_ruta" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Mensaje de Cambio</label>
            <input type="text" name="mensaje_cambio" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" value="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Imagen (URL)</label>
            <input type="text" name="imagen" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" value="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">¿Es submenú?</label>
            <select name="es_submenu" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="0">No</option>
                <option value="1">Sí</option>
            </select>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Módulo Padre</label>
            <select name="modulo_padre_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Ninguno</option>
                <!-- Opciones de módulos padre -->
            </select>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('modulos.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection 
=======
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Editar Módulo</h1>
        <p class="text-primary-300">Actualiza la información del módulo en el sistema BoxWare</p>
    </div>
    <a href="{{ route('modulos.index') }}" 
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
                    <i class="fas fa-puzzle-piece text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Información del Módulo</h3>
                    <p class="text-primary-300 text-sm">Actualiza los campos que deseas modificar</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form method="POST" action="{{ route('modulos.update', $modulo->id_modulo) }}" class="space-y-8">
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
                                    <i class="fas fa-route mr-2 text-accent-500"></i>
                                    Ruta
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="rutas" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa la ruta del módulo"
                                   value="{{ old('rutas', $modulo->rutas) }}" required>
                            @error('rutas')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-tag mr-2 text-accent-500"></i>
                                    Descripción
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="descripcion_ruta" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa una descripción para el módulo"
                                   value="{{ old('descripcion_ruta', $modulo->descripcion_ruta) }}" required>
                            @error('descripcion_ruta')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Additional Information Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-list-alt text-white text-sm"></i>
                        </div>
                        Información Adicional
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-comment-alt mr-2 text-accent-500"></i>
                                    Mensaje de Cambio
                                </span>
                            </label>
                            <input type="text" name="mensaje_cambio" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Mensaje opcional para cambios"
                                   value="{{ old('mensaje_cambio', $modulo->mensaje_cambio) }}">
                            @error('mensaje_cambio')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-image mr-2 text-accent-500"></i>
                                    Imagen (URL)
                                </span>
                            </label>
                            <input type="text" name="imagen" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="URL de la imagen para el módulo"
                                   value="{{ old('imagen', $modulo->imagen) }}">
                            @error('imagen')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Configuration Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-cogs text-white text-sm"></i>
                        </div>
                        Configuración
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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
                                <option value="1" class="bg-primary-800" {{ old('estado', $modulo->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" class="bg-primary-800" {{ old('estado', $modulo->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-sitemap mr-2 text-accent-500"></i>
                                    ¿Es submenú?
                                </span>
                            </label>
                            <select name="es_submenu" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                                <option value="0" class="bg-primary-800" {{ old('es_submenu', $modulo->es_submenu) == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" class="bg-primary-800" {{ old('es_submenu', $modulo->es_submenu) == 1 ? 'selected' : '' }}>Sí</option>
                            </select>
                            @error('es_submenu')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-level-up-alt mr-2 text-accent-500"></i>
                                    Módulo Padre
                                </span>
                            </label>
                            <select name="modulo_padre_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                                <option value="" class="bg-primary-800">Ninguno</option>
                                @if(isset($modulos))
                                    @foreach($modulos as $moduloPadre)
                                        @if($moduloPadre->id_modulo != $modulo->id_modulo)
                                            <option value="{{ $moduloPadre->id_modulo }}" class="bg-primary-800" {{ old('modulo_padre_id', $modulo->modulo_padre_id) == $moduloPadre->id_modulo ? 'selected' : '' }}>
                                                {{ $moduloPadre->descripcion_ruta }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('modulo_padre_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="border-t border-primary-700 pt-6 flex justify-end">
                    <a href="{{ route('modulos.index') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center mr-4">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" class="bg-accent-600 hover:bg-accent-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Actualizar Módulo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
