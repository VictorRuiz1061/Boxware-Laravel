@extends('layouts.app')

@section('title', 'Crear Permiso | BoxWare')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Crear Nuevo Permiso</h2>
        <a href="{{ route('permisos.index') }}" class="flex items-center text-gray-600 hover:text-primary-600">
            <i class="fas fa-arrow-left mr-2"></i> Volver a la lista
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <p class="font-bold">¡Error!</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('permisos.store') }}" class="space-y-6">
        @csrf
        
        <!-- Información Básica -->
        <div class="bg-gray-50 p-6 rounded-xl">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Información Básica</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Permiso</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                           placeholder="Ej: Ver Reportes" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select name="estado" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="1" {{ old('estado', 1) == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Permisos -->
        <div class="bg-gray-50 p-6 rounded-xl">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Permisos</h3>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Puede ver</label>
                    <select name="puede_ver" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="1" {{ old('puede_ver', 1) == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('puede_ver') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Puede crear</label>
                    <select name="puede_crear" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="1" {{ old('puede_crear', 0) == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('puede_crear') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Puede editar</label>
                    <select name="puede_editar" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="1" {{ old('puede_editar', 0) == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('puede_editar') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Módulos y Roles -->
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-6 rounded-xl">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Módulos</h3>
                <div class="space-y-2 max-h-60 overflow-y-auto p-2 border border-gray-200 rounded-lg bg-white">
                    @forelse($modulos as $modulo)
                        <div class="flex items-center p-2 hover:bg-gray-50 rounded">
                            <input type="checkbox" id="modulo-{{ $modulo->id_modulo }}" 
                                   name="modulo_id[]" value="{{ $modulo->id_modulo }}"
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                                   {{ in_array($modulo->id_modulo, old('modulo_id', [])) ? 'checked' : '' }}>
                            <label for="modulo-{{ $modulo->id_modulo }}" class="ml-2 text-sm text-gray-700">
                                {{ $modulo->descripcion_ruta }}
                            </label>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No hay módulos disponibles</p>
                    @endforelse
                </div>
                @error('modulo_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="bg-gray-50 p-6 rounded-xl">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Rol</h3>
                <select name="rol_id" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Selecciona un rol</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id_rol }}" {{ old('rol_id') == $rol->id_rol ? 'selected' : '' }}>
                            {{ $rol->nombre_rol }}
                        </option>
                    @endforeach
                </select>
                @error('rol_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('permisos.index') }}" 
               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                Cancelar
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <i class="fas fa-save mr-2"></i> Guardar Permiso
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Script para manejar la selección de módulos
    document.addEventListener('DOMContentLoaded', function() {
        // Validación del formulario
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const modulos = document.querySelectorAll('input[name="modulo_id[]"]:checked');
            const rol = document.querySelector('select[name="rol_id"]').value;
            
            if (modulos.length === 0) {
                e.preventDefault();
                alert('Por favor selecciona al menos un módulo');
                return false;
            }
            
            if (!rol) {
                e.preventDefault();
                alert('Por favor selecciona un rol');
                return false;
            }
            
            return true;
        });
    });
</script>
@endpush
@endsection