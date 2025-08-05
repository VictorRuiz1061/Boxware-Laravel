@extends('layouts.app')

@section('title', 'Editar Permiso | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Editar Permiso</h2>
    <form method="POST" action="#">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="nombre" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="mb-4 grid grid-cols-3 gap-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Puede ver</label>
                <select name="puede_ver" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Puede crear</label>
                <select name="puede_crear" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Puede editar</label>
                <select name="puede_editar" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Módulo</label>
            <select name="modulo_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Selecciona un módulo</option>
                @foreach($modulos as $modulo)
                    <option value="{{ $modulo->id_modulo }}" {{ (old('modulo_id', $permiso->modulo_id) == $modulo->id_modulo) ? 'selected' : '' }}>{{ $modulo->descripcion_ruta }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Rol</label>
            <select name="rol_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Selecciona un rol</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->id_rol }}" {{ (old('rol_id', $permiso->rol_id) == $rol->id_rol) ? 'selected' : '' }}>{{ $rol->nombre_rol }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('permisos.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection 