@extends('layouts.app')

@section('title', 'Editar Categoría | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center mb-8">
    <a href="{{ route('categorias_elementos.index') }}" class="flex items-center justify-center w-10 h-10 rounded-lg bg-primary-700 hover:bg-primary-600 mr-3 transition-all duration-200">
        <i class="fas fa-arrow-left text-white"></i>
    </a>
    <div>
        <h1 class="text-3xl font-bold text-white mb-1">Editar Categoría</h1>
        <p class="text-primary-300">Modifica la información de la categoría seleccionada</p>
    </div>
</div>

<!-- Form Container -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Form Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-tag text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Información de la Categoría</h3>
                <p class="text-primary-300 text-sm">Todos los campos marcados con <span class="text-red-500">*</span> son obligatorios</p>
            </div>
        </div>
    </div>

    <!-- Form Content -->
    <div class="p-8">
        <form action="{{ route('categorias_elementos.update', $categoria->id_categoria_elemento) }}" method="POST" class="space-y-8">
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

            <!-- Campos de Categoría -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white font-medium mb-2">Código QNPSC <span class="text-red-500">*</span></label>
                    <input type="text" name="codigo_qnpsc" value="{{ old('codigo_qnpsc', $categoria->codigo_qnpsc) }}" class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500" placeholder="Ingrese el código">
                    @error('codigo_qnpsc')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-white font-medium mb-2">Nombre de la Categoría <span class="text-red-500">*</span></label>
                    <input type="text" name="nombre_categoria" value="{{ old('nombre_categoria', $categoria->nombre_categoria) }}" class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500" placeholder="Ingrese el nombre">
                    @error('nombre_categoria')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-white font-medium mb-2">Estado <span class="text-red-500">*</span></label>
                    <select name="estado" class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500">
                        <option class="bg-primary-800" value="1" {{ old('estado', $categoria->estado) == 1 ? 'selected' : '' }}>Activa</option>
                        <option class="bg-primary-800" value="0" {{ old('estado', $categoria->estado) == 0 ? 'selected' : '' }}>Inactiva</option>
                    </select>
                    @error('estado')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-4 border-t border-primary-700">
                <a href="{{ route('categorias_elementos.index') }}" class="px-6 py-3 bg-primary-700 hover:bg-primary-600 text-white rounded-lg font-medium transition-all duration-200">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-3 bg-accent-600 hover:bg-accent-500 text-white rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-save mr-2"></i> Actualizar Categoría
                </button>
            </div>
        </form>
    </div>
</div>
@endsection