@extends('layouts.app')

@section('title', 'Editar Movimiento | BoxWare')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Editar Movimiento</h2>
    <form method="POST" action="{{ route('movimientos.update', $movimiento->id_movimiento) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Cantidad</label>
                <input type="number" name="cantidad" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required value="{{ old('cantidad', $movimiento->cantidad) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Estado</label>
                <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="1" {{ old('estado', $movimiento->estado) == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado', $movimiento->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Usuario Movimiento</label>
                <select name="usuario_movimiento_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                    <option value="">Selecciona un usuario</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id_usuario }}" {{ (old('usuario_movimiento_id', $movimiento->usuario_movimiento_id) == $usuario->id_usuario) ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Usuario Responsable</label>
                <select name="usuario_responsable_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                    <option value="">Selecciona un usuario</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id_usuario }}" {{ (old('usuario_responsable_id', $movimiento->usuario_responsable_id) == $usuario->id_usuario) ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Material</label>
                <select name="material_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                    <option value="">Selecciona un material</option>
                    @foreach($materiales as $material)
                        <option value="{{ $material->id_material }}" {{ (old('material_id', $movimiento->material_id) == $material->id_material) ? 'selected' : '' }}>{{ $material->nombre_material }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tipo de Movimiento</label>
                <select name="tipo_movimiento_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                    <option value="">Selecciona un tipo de movimiento</option>
                    @foreach($tipo_movimientos as $tipo_movimiento)
                        <option value="{{ $tipo_movimiento->id_tipo_movimiento }}" {{ (old('tipo_movimiento_id', $movimiento->tipo_movimiento_id) == $tipo_movimiento->id_tipo_movimiento) ? 'selected' : '' }}>{{ $tipo_movimiento->tipo_movimiento }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Sitio</label>
                <select name="sitio_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
                    <option value="">Selecciona un sitio</option>
                    @foreach($sitios as $sitio)
                        <option value="{{ $sitio->id_sitio }}" {{ (old('sitio_id', $movimiento->sitio_id) == $sitio->id_sitio) ? 'selected' : '' }}>{{ $sitio->nombre_sitio }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Sitio Origen</label>
                <select name="sitio_origen_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Selecciona un sitio origen</option>
                    @foreach($sitios as $sitio)
                        <option value="{{ $sitio->id_sitio }}" {{ (old('sitio_origen_id', $movimiento->sitio_origen_id) == $sitio->id_sitio) ? 'selected' : '' }}>{{ $sitio->nombre_sitio }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Sitio Destino</label>
                <select name="sitio_destino_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Selecciona un sitio destino</option>
                    @foreach($sitios as $sitio)
                        <option value="{{ $sitio->id_sitio }}" {{ (old('sitio_destino_id', $movimiento->sitio_destino_id) == $sitio->id_sitio) ? 'selected' : '' }}>{{ $sitio->nombre_sitio }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="flex justify-end">
            <a href="{{ route('movimientos.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection 