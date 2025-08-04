@extends('layouts.app')

@section('title', 'Crear Programa | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Crear Programa</h2>
    <form method="POST" action="{{ route('programas.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="programas.create" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
 
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">area_id</label>
            <input type="text" name="area_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
            <select name="area_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Selecciona un area</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id_area }}" {{ old('area_id') == $area->id_area ? 'selected' : '' }}>{{ $area->nombre_area }}</option>
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