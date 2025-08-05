@extends('layouts.app')

@section('title', 'Editar Centro | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Editar Centro</h2>
    <form method="POST" action="{{ route('centro.update', $centro->id_centro) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre del Centro</label>
            <input type="text" name="nombre_centro" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('nombre_centro', $centro->nombre_centro) }}">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Municipio</label>
            <select name="municipio_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                <option value="">Selecciona un municipio</option>
                @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id_municipio }}" {{ (old('municipio_id', $centro->municipio_id) == $municipio->id_municipio) ? 'selected' : '' }}>{{ $municipio->nombre_municipio }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1" {{ old('estado', $centro->estado) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado', $centro->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('centro.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection 