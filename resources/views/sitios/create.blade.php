@extends('layouts.app')

@section('title', 'Crear Sitio | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Crear Sitio</h2>
    <form method="POST" action="{{ route('sitios.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre del Sitio</label>
            <input type="text" name="nombre_sitio" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Ubicación</label>
            <input type="text" name="ubicacion" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Ficha Técnica</label>
            <input type="text" name="ficha_tecnica" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Tipo de Sitio</label>
            <select name="tipo_sitio_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                <option value="">Seleccione un tipo de sitio</option>
                @foreach($tiposSitio as $tipoSitio)
                    <option value="{{ $tipoSitio->id_tipo_sitio }}">{{ $tipoSitio->nombre_tipo_sitio }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('sitios.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Guardar</button>
        </div>
    </form>
</div>
@endsection
