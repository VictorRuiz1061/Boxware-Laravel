@extends('layouts.app')

@section('title', 'Editar Ficha | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center mb-8">
    <a href="{{ route('fichas.index') }}" class="flex items-center justify-center w-10 h-10 rounded-lg bg-primary-700 hover:bg-primary-600 mr-3 transition-all duration-200">
        <i class="fas fa-arrow-left text-white"></i>
    </a>
    <div>
        <h1 class="text-3xl font-bold text-white mb-1">Editar Ficha</h1>
        <p class="text-primary-300">Modifica la información de la ficha seleccionada</p>
    </div>
</div>

<!-- Form Container -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Form Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-id-card text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Información de la Ficha</h3>
                <p class="text-primary-300 text-sm">Todos los campos marcados con <span class="text-red-500">*</span> son obligatorios</p>
            </div>
        </div>
    </div>

    <!-- Form Content -->
    <div class="p-8">
        <form action="{{ route('fichas.update', $ficha->id_ficha) }}" method="POST" class="space-y-8">
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

            <!-- ID Ficha (readonly) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label for="id_ficha" class="block text-white font-medium mb-2">ID de la Ficha</label>
                    <input type="text" id="id_ficha" value="{{ $ficha->id_ficha }}" 
                           class="w-full bg-primary-800 bg-opacity-50 border border-primary-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-accent-500"
                           readonly disabled>
                </div>
            </div>

            <!-- Instructor Selection -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label for="usuario_id" class="block text-white font-medium mb-2">Instructor <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="usuario_id" name="usuario_id" class="w-full bg-primary-800 bg-opacity-50 border border-primary-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-accent-500 appearance-none">
                            <option value="" disabled>Selecciona un instructor</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id_usuario }}" {{ old('usuario_id', $ficha->usuario_id) == $usuario->id_usuario ? 'selected' : '' }}>
                                    {{ $usuario->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <i class="fas fa-chevron-down text-primary-400"></i>
                        </div>
                    </div>
                    @error('usuario_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Programa Selection -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label for="programa_id" class="block text-white font-medium mb-2">Programa <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="programa_id" name="programa_id" class="w-full bg-primary-800 bg-opacity-50 border border-primary-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-accent-500 appearance-none">
                            <option value="" disabled>Selecciona un programa</option>
                            @foreach($programas as $programa)
                                <option value="{{ $programa->id_programa }}" {{ old('programa_id', $ficha->programa_id) == $programa->id_programa ? 'selected' : '' }}>
                                    {{ $programa->nombre_programa }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <i class="fas fa-chevron-down text-primary-400"></i>
                        </div>
                    </div>
                    @error('programa_id')
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
                            <input type="radio" name="estado" value="1" class="form-radio h-5 w-5 text-accent-600 border-primary-600 bg-primary-800 bg-opacity-50 focus:ring-accent-500" {{ old('estado', $ficha->estado) == 1 ? 'checked' : '' }}>
                            <span class="ml-2 text-white">Activa</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="estado" value="0" class="form-radio h-5 w-5 text-accent-600 border-primary-600 bg-primary-800 bg-opacity-50 focus:ring-accent-500" {{ old('estado', $ficha->estado) == 0 ? 'checked' : '' }}>
                            <span class="ml-2 text-white">Inactiva</span>
                        </label>
                    </div>
                    @error('estado')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-4 border-t border-primary-700">
                <a href="{{ route('fichas.index') }}" class="px-6 py-3 bg-primary-700 hover:bg-primary-600 text-white rounded-lg font-medium transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-3 bg-accent-600 hover:bg-accent-500 text-white rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-save mr-2"></i> Actualizar Ficha
                </button>
            </div>
        </form>
    </div>
</div>
@endsection