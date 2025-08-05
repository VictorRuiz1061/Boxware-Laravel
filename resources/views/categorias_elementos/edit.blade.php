@extends('layouts.app')

@section('title', 'Editar Categoría de Elemento | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Editar Categoría de Elemento</h2>
    <form method="POST" action="{{ route('categorias_elementos.update', $categoria->id_categoria_elemento) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Código QNPSC</label>
            <input type="text" name="codigo_qnpsc" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('codigo_qnpsc', $categoria->codigo_qnpsc) }}">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="nombre_categoria" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('nombre_categoria', $categoria->nombre_categoria) }}">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1" {{ old('estado', $categoria->estado) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado', $categoria->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('categorias_elementos.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection 