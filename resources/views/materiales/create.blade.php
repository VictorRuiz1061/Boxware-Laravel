@extends('layouts.app')

@section('title', 'Crear Material | BoxWare')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Crear Material</h2>
    <form method="POST" action="{{ route('materiales.store') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Código SENA</label>
                <input type="text" name="codigo_sena" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nombre del Material</label>
                <input type="text" name="nombre_material" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <textarea name="descripcion_material" rows="3" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required></textarea>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Unidad de Medida</label>
                <input type="text" name="unidad_medida" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Fecha de Vencimiento</label>
                <input type="date" name="fecha_vencimiento" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tipo de Material</label>
                <select name="tipo_material_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                    <option value="">Selecciona un tipo</option>
                    @foreach($tiposMaterial as $tipo)
                    <option value="{{ $tipo->id_tipo_material }}" {{ old('tipo_material_id') == $tipo->id_tipo_material ? 'selected' : '' }}>{{ $tipo->tipo_elemento }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Producto Peresedero</label>
                <select name="producto_peresedero" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">URL de Imagen</label>
            <input type="text" name="imagen" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        
        <div class="flex justify-end">
            <a href="{{ route('materiales.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Guardar</button>
        </div>
    </form>
</div>
@endsection 