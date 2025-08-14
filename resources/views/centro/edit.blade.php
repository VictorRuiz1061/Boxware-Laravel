@extends('layouts.app')

@section('title', 'Editar Centro | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center mb-8">
    <a href="{{ route('centro.index') }}" class="flex items-center justify-center w-10 h-10 rounded-lg bg-primary-700 hover:bg-primary-600 mr-3 transition-all duration-200">
        <i class="fas fa-arrow-left text-white"></i>
    </a>
    <div>
        <h1 class="text-3xl font-bold text-white mb-1">Editar Centro</h1>
        <p class="text-primary-300">Modifica la información del centro seleccionado</p>
    </div>
</div>

<!-- Form Container -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Form Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-building text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Información del Centro</h3>
                <p class="text-primary-300 text-sm">Todos los campos marcados con <span class="text-red-500">*</span> son obligatorios</p>
            </div>
        </div>
    </div>

    <!-- Form Content -->
    <div class="p-8">
        <form action="{{ route('centro.update', $centro->id_centro) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-900 bg-opacity-30 border border-red-700 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-3"></i>
                        <div>
                            <h3 class="text-red-500 font-semibold mb-1">Se encontraron los siguientes errores:</h3>
                            <ul class="text-red-400 text-sm space-y-1 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Nombre Centro -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label for="nombre_centro" class="block text-white font-medium mb-2">Nombre del Centro <span class="text-red-500">*</span></label>
                    <input type="text" id="nombre_centro" name="nombre_centro" value="{{ old('nombre_centro', $centro->nombre_centro) }}" 
                           class="w-full bg-primary-800 bg-opacity-50 border border-primary-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-accent-500"
                           placeholder="Ingrese el nombre del centro">
                    @error('nombre_centro')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Municipio Selection -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label for="municipio_id" class="block text-white font-medium mb-2">Municipio <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="municipio_id" name="municipio_id" class="w-full bg-primary-800 bg-opacity-50 border border-primary-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-accent-500 appearance-none">
                            <option value="" disabled>Selecciona un municipio</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}" {{ old('municipio_id', $centro->municipio_id) == $municipio->id_municipio ? 'selected' : '' }}>
                                    {{ $municipio->nombre_municipio }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <i class="fas fa-chevron-down text-primary-400"></i>
                        </div>
                    </div>
                    @error('municipio_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Estado -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white font-medium mb-2">Estado <span class="text-red-500">*</span></label>
                    <div class="flex items-center space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="estado" value="1" class="form-radio h-5 w-5 text-accent-600 border-primary-600 bg-primary-800 bg-opacity-50 focus:ring-accent-500" {{ old('estado', $centro->estado) == 1 ? 'checked' : '' }}>
                            <span class="ml-2 text-white">Activo</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="estado" value="0" class="form-radio h-5 w-5 text-accent-600 border-primary-600 bg-primary-800 bg-opacity-50 focus:ring-accent-500" {{ old('estado', $centro->estado) == 0 ? 'checked' : '' }}>
                            <span class="ml-2 text-white">Inactivo</span>
                        </label>
                    </div>
                    @error('estado')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-4 border-t border-primary-700">
                <a href="{{ route('centro.index') }}" class="px-6 py-3 bg-primary-700 hover:bg-primary-600 text-white rounded-lg font-medium transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-3 bg-accent-600 hover:bg-accent-500 text-white rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-save mr-2"></i> Actualizar Centro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection