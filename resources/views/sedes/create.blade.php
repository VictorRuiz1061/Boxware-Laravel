@extends('layouts.app')

@section('title', 'Crear Sede | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Crear Sede</h2>
    <form method="POST" action="#">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre de la Sede</label>
            <input type="text" name="nombre_sede" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Dirección de la Sede</label>
            <input type="text" name="direccion_sede" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Fecha de Creación</label>
            <input type="date" name="fecha_creacion" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Fecha de Modificación</label>
            <input type="date" name="fecha_modificacion" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Centro</label>
            <select name="centro_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                <option value="">Seleccione un Centro</option>
                <!-- Aquí puedes agregar las opciones dinámicamente desde tu base de datos -->
                <option value="1">Centro 1</option>
                <option value="2">Centro 2</option>
                <!-- Agrega más centros según sea necesario -->
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
            <button type="submit" class="w-full bg-blue-500 text-white rounded-lg py-2 hover:bg-blue-600">Crear Sede</button>
        </div>
    </form>
</div>
@endsection
