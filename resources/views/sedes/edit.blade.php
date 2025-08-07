@extends('layouts.app')

@section('title', 'Editar Sede | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Editar Sede</h2>
    <form method="POST" action="#">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre de la Sede</label>
            <input type="text" name="nombre_sede" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Dirección de la Sede</label>
            <input type="text" name="direccion_sede" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Fecha de Creación</label>
            <input type="date" name="fecha_creacion" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Fecha de Modificación</label>
            <input type="date" name="fecha_modificacion" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" value="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Centro</label>
            <select name="centro_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                <option value="">Seleccione un Centro</option>
                <!-- Opciones de centros dinámicamente -->
                @foreach($centros as $centro)
                    <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="mb-4">
            <button type="submit" class="w-full bg-blue-500 text-white rounded-lg py-2 hover:bg-blue-600">Actualizar Sede</button>
        </div>
    </form>
</div>
@endsection
