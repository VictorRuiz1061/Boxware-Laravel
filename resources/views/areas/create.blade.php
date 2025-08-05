@extends('layouts.app')

@section('title', 'Crear Area | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Crear Area</h2>
    <form method="POST" action="{{ route('areas.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="nombre_area" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Sede</label>
            <select name="sede_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
    <option value="">Selecciona una sede</option>
    @foreach($sedes as $sede)
        <option value="{{ $sede->id_sede }}" {{ old('sede_id') == $sede->id_sede ? 'selected' : '' }}>{{$sede->nombre_sede }}</option>
    @endforeach
</select>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('programas.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Guardar</button>
        </div>
    </form>
</div>
@endsection