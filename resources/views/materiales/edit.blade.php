@extends('layouts.app')

@section('title', 'Editar Material | BoxWare')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Editar Material</h2>
    <form method="POST" action="{{ route('materiales.update', $material->id_material) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Código SENA</label>
                <input type="text" name="codigo_sena" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('codigo_sena', $material->codigo_sena) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nombre del Material</label>
                <input type="text" name="nombre_material" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('nombre_material', $material->nombre_material) }}">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <textarea name="descripcion_material" rows="3" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>{{ old('descripcion_material', $material->descripcion_material) }}</textarea>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Unidad de Medida</label>
                <input type="text" name="unidad_medida" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('unidad_medida', $material->unidad_medida) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Fecha de Vencimiento</label>
                <input type="date" name="fecha_vencimiento" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('fecha_vencimiento', $material->fecha_vencimiento) }}">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tipo de Material</label>
                <select name="tipo_material_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                    <option value="">Selecciona un tipo</option>
                    @foreach($tiposMaterial as $tipo)
                        <option value="{{ $tipo->id_tipo_material }}" {{ (old('tipo_material_id', $material->tipo_material_id) == $tipo->id_tipo_material) ? 'selected' : '' }}>{{ $tipo->nombre_tipo_material }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Producto Peresedero</label>
                <select name="producto_peresedero" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                    <option value="1" {{ old('producto_peresedero', $material->producto_peresedero) == 1 ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ old('producto_peresedero', $material->producto_peresedero) == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">URL de Imagen</label>
            <input type="text" name="imagen" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('imagen', $material->imagen) }}">
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1" {{ old('estado', $material->estado) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado', $material->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        
        <div class="flex justify-end">
            <a href="{{ route('materiales.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection 