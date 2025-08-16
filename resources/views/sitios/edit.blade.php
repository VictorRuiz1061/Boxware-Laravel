@extends('layouts.app')

@section('title', 'Editar Sitio | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Editar Sitio</h1>
        <p class="text-primary-300">Modifica la información del sitio seleccionado</p>
    </div>
    <a href="{{ route('sitios.index') }}" 
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
                    <i class="fas fa-map-marker-alt text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Información del Sitio</h3>
                    <p class="text-primary-300 text-sm">Completa todos los campos requeridos</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form method="POST" action="{{ route('sitios.update', $sitio->id_sitio) }}" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Sitio Information Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-info-circle text-white text-sm"></i>
                        </div>
                        Información del Sitio
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-signature mr-2 text-accent-500"></i>
                                    Nombre del Sitio
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="nombre_sitio" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa el nombre del sitio"
                                   value="{{ old('nombre_sitio', $sitio->nombre_sitio) }}" required>
                            @error('nombre_sitio')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-map-pin mr-2 text-accent-500"></i>
                                    Ubicación
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="ubicacion" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa la ubicación del sitio"
                                   value="{{ old('ubicacion', $sitio->ubicacion) }}" required>
                            @error('ubicacion')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-list-alt mr-2 text-accent-500"></i>
                                    Tipo de Sitio
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="tipo_sitio_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                @foreach($tiposSitio as $tipoSitio)
                                    <option value="{{ $tipoSitio->id_tipo_sitio }}" class="bg-primary-800" {{ old('tipo_sitio_id', $sitio->tipo_sitio_id) == $tipoSitio->id_tipo_sitio ? 'selected' : '' }}>
                                        {{ $tipoSitio->nombre_tipo_sitio }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_sitio_id')
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
                                <option value="1" class="bg-primary-800" {{ old('estado', $sitio->estado ?? '1') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" class="bg-primary-800" {{ old('estado', $sitio->estado ?? '1') == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-primary-200 font-semibold mb-3">
                            <span class="flex items-center">
                                <i class="fas fa-signature mr-2 text-accent-500"></i>
                                Fichas Técnicas
                                <span class="text-red-400 ml-1">*</span>
                            </span>
                        </label>
                        <input type="text" name="ficha_tecnica" 
                                class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                placeholder="Ingresa la ficha técnica del sitio"
                                value="{{ old('ficha_tecnica', $sitio->ficha_tecnica) }}" required>
                        @error('ficha_tecnica')
                            <p class="mt-2 text-red-400 text-sm flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="border-t border-primary-700 pt-6 flex justify-end">
                    <a href="{{ route('sitios.index') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center mr-4">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" class="bg-accent-600 hover:bg-accent-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Actualizar Sitio
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection