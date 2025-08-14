@extends('layouts.app')

@section('title', 'Editar Material | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Editar Material</h1>
        <p class="text-primary-300">Actualiza la información del material en el sistema BoxWare</p>
    </div>
    <a href="{{ route('materiales.index') }}" 
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
                    <i class="fas fa-box text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Información del Material</h3>
                    <p class="text-primary-300 text-sm">Actualiza los campos que deseas modificar</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form method="POST" action="{{ route('materiales.update', $material->id_material) }}" enctype="multipart/form-data" class="space-y-8">
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
                                    <i class="fas fa-barcode mr-2 text-accent-500"></i>
                                    Código SENA
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="codigo_sena" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa el código SENA del material"
                                   value="{{ old('codigo_sena', $material->codigo_sena) }}" required>
                            @error('codigo_sena')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-tag mr-2 text-accent-500"></i>
                                    Nombre Material
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="nombre_material" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa el nombre del material"
                                   value="{{ old('nombre_material', $material->nombre_material) }}" required>
                            @error('nombre_material')
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
                                    <i class="fas fa-align-left mr-2 text-accent-500"></i>
                                    Descripción Material
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <textarea name="descripcion_material" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa la descripción del material"
                                   rows="3" required>{{ old('descripcion_material', $material->descripcion_material) }}</textarea>
                            @error('descripcion_material')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-ruler mr-2 text-accent-500"></i>
                                    Unidad de Medida
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" name="unidad_medida" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ej: Kilogramos, Unidades, Metros"
                                   value="{{ old('unidad_medida', $material->unidad_medida) }}" required>
                            @error('unidad_medida')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Configuration Section -->
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-calendar-alt mr-2 text-accent-500"></i>
                                    Fecha de Vencimiento
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="date" name="fecha_vencimiento" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" 
                                   value="{{ old('fecha_vencimiento', $material->fecha_vencimiento) }}" required>
                            @error('fecha_vencimiento')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-apple-alt mr-2 text-accent-500"></i>
                                    Producto Perecedero
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="producto_peresedero" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                <option value="1" class="bg-primary-800" {{ old('producto_peresedero', $material->producto_peresedero) == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" class="bg-primary-800" {{ old('producto_peresedero', $material->producto_peresedero) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('producto_peresedero')
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
                                <option value="1" class="bg-primary-800" {{ old('estado', $material->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" class="bg-primary-800" {{ old('estado', $material->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Tipo Material and Image Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-file-image text-white text-sm"></i>
                        </div>
                        Tipo de Material e Imagen
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-user-shield mr-2 text-accent-500"></i>
                                    Tipo de Material
                                </span>
                            </label>
                            <select name="tipo_material_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                                <option value="" class="bg-primary-800">Selecciona un tipo</option>
                                @foreach($tiposMaterial as $tipo)
                                    <option value="{{ $tipo->id_tipo_material }}" class="bg-primary-800" {{ old('tipo_material_id') == $tipo->id_tipo_material ? 'selected' : '' }}>
                                        {{ $tipo->tipo_elemento }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_material_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-image mr-2 text-accent-500"></i>
                                    Imagen
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <div class="flex items-center space-x-4">
                                @if($material->imagen)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/materiales/' . $material->imagen) }}" alt="{{ $material->nombre_material }}" class="h-16 w-16 object-cover rounded-lg border border-primary-600">
                                </div>
                                @endif
                                <input type="file" name="imagen" 
                                       class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                            </div>
                            <p class="mt-1 text-primary-400 text-xs">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB.</p>
                            @error('imagen')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="border-t border-primary-700 pt-6 flex justify-end">
                    <a href="{{ route('materiales.index') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center mr-4">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" class="bg-accent-600 hover:bg-accent-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Actualizar Material
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection