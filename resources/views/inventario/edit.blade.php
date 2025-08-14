@extends('layouts.app')

@section('title', 'Editar Elemento de Inventario | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Editar Elemento de Inventario</h1>
        <p class="text-primary-300">Modifica la información del elemento de inventario seleccionado</p>
    </div>
    <a href="{{ route('inventario.index') }}" 
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
                    <i class="fas fa-warehouse text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Información del Elemento</h3>
                    <p class="text-primary-300 text-sm">Completa todos los campos requeridos</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form method="POST" action="{{ route('inventario.update', $inventario->id_inventario) }}" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Inventario Information Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-info-circle text-white text-sm"></i>
                        </div>
                        Información del Elemento
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-boxes mr-2 text-accent-500"></i>
                                    Material
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="material_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                @foreach($materiales as $material)
                                    <option value="{{ $material->id_material }}" class="bg-primary-800" {{ old('material_id', $inventario->material_id) == $material->id_material ? 'selected' : '' }}>
                                        {{ $material->nombre_material }}
                                    </option>
                                @endforeach
                            </select>
                            @error('material_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-accent-500"></i>
                                    Sitio
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="sitio_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                @foreach($sitios as $sitio)
                                    <option value="{{ $sitio->id_sitio }}" class="bg-primary-800" {{ old('sitio_id', $inventario->sitio_id) == $sitio->id_sitio ? 'selected' : '' }}>
                                        {{ $sitio->nombre_sitio }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sitio_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-cubes mr-2 text-accent-500"></i>
                                    Stock
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="number" name="stock" min="0" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa la cantidad"
                                   value="{{ old('stock', $inventario->stock) }}" required>
                            @error('stock')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-tag mr-2 text-accent-500"></i>
                                    Placa SENA
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="placa_sena" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa la placa SENA"
                                   value="{{ old('placa_sena', $inventario->placa_sena) }}" required>
                            @error('placa_sena')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-primary-200 font-semibold mb-3">
                            <span class="flex items-center">
                                <i class="fas fa-file-alt mr-2 text-accent-500"></i>
                                Descripción
                                <span class="text-red-400 ml-1">*</span>
                            </span>
                        </label>
                        <textarea name="descripcion" rows="5"
                                  class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                  placeholder="Ingresa una descripción del elemento" required>{{ old('descripcion', $inventario->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="mt-2 text-red-400 text-sm flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="border-t border-primary-700 pt-6 flex justify-end">
                    <a href="{{ route('inventario.index') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center mr-4">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" class="bg-accent-600 hover:bg-accent-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Actualizar Elemento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection