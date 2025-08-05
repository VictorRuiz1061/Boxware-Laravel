@extends('layouts.app')

@section('title', 'Crear Módulo | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Crear Módulo</h2>
    <form method="POST" action="{{ route('modulos.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Ruta</label>
            <input type="text" name="rutas" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <input type="text" name="descripcion_ruta" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Mensaje de Cambio</label>
            <input type="text" name="mensaje_cambio" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Imagen (URL)</label>
            <input type="text" name="imagen" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
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
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Guardar</button>
        </div>
    </form>
</div>
@endsection 