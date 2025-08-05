@extends('layouts.app')

@section('title', 'Editar Elemento de Inventario | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Editar Elemento de Inventario</h2>
    <form method="POST" action="{{ route('inventario.update', $inventario->id_inventario) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Stock</label>
            <input type="number" name="stock" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('stock', $inventario->stock) }}">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Placa SENA</label>
            <input type="text" name="placa_sena" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('placa_sena', $inventario->placa_sena) }}">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <input type="text" name="descripcion" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('descripcion', $inventario->descripcion) }}">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Sitio</label>
            <select name="sitio_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                <option value="">Seleccione un sitio</option>
                @foreach($sitios as $sitio)
                    <option value="{{ $sitio->id_sitio }}" {{ old('sitio_id', $inventario->sitio_id) == $sitio->id_sitio ? 'selected' : '' }}>{{ $sitio->nombre_sitio }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('inventario.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection
