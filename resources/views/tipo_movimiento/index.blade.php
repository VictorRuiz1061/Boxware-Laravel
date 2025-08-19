@extends('layouts.app')

@section('title', 'Tipos de Movimiento | BoxWare')

@section('content')
<<<<<<< HEAD
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Tipos de Movimiento</h2>
    <a href="{{ route('tipo_movimiento.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Tipo de Movimiento</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Tipo de movimiento</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tiposMovimiento as $tipoMovimiento)
                <tr>
                    <td class="px-4 py-2">{{ $tipoMovimiento->id_tipo_movimiento }}</td>
                    <td class="px-4 py-2">{{ $tipoMovimiento->tipo_movimiento }}</td>
                    <td class="px-4 py-2">
                        @if($tipoMovimiento->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('tipo_movimiento.edit', $tipoMovimiento->id_tipo_movimiento) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No hay tipos de movimiento registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 
=======
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Tipos de Movimiento</h1>
        <p class="text-primary-300">Administra los tipos de movimiento del sistema BoxWare</p>
    </div>
    <a href="{{ route('tipo_movimiento.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-plus text-sm"></i>
        <span>Nuevo Tipo de Movimiento</span>
    </a>
</div>

<!-- Content Section -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-exchange-alt text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Lista de Tipos de Movimiento</h3>
                <p class="text-primary-300 text-sm">{{ count($tiposMovimiento) }} tipos de movimiento encontrados</p>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-primary-300 border-b border-primary-700">
                        <th class="pb-4 font-semibold">ID</th>
                        <th class="pb-4 font-semibold">Tipo de Movimiento</th>
                        <th class="pb-4 font-semibold">Estado</th>
                        <th class="pb-4 font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tiposMovimiento as $tipoMovimiento)
                        <tr class="border-b border-primary-700 hover:bg-primary-800 hover:bg-opacity-50 transition-colors duration-200">
                            <td class="py-4 text-white">{{ $tipoMovimiento->id_tipo_movimiento }}</td>
                            <td class="py-4 text-white">{{ $tipoMovimiento->tipo_movimiento }}</td>
                            <td class="py-4">
                                @if ($tipoMovimiento->estado)
                                    <span class="px-3 py-1 bg-green-500 bg-opacity-20 text-green-500 rounded-full text-xs font-semibold">
                                        Activo
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-500 bg-opacity-20 text-red-500 rounded-full text-xs font-semibold">
                                        Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('tipo_movimiento.edit', $tipoMovimiento->id_tipo_movimiento) }}" 
                                       class="p-2 bg-primary-700 hover:bg-primary-600 rounded-lg text-primary-300 hover:text-white transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-primary-300">
                                <div class="flex flex-col items-center justify-center space-y-4">
                                    <div class="w-16 h-16 bg-primary-800 rounded-full flex items-center justify-center">
                                        <i class="fas fa-exchange-alt text-primary-600 text-2xl"></i>
                                    </div>
                                    <p>No hay tipos de movimiento registrados</p>
                                    <a href="{{ route('tipo_movimiento.create') }}" class="text-accent-500 hover:text-accent-400 transition-colors duration-200">
                                        Crear un nuevo tipo de movimiento
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
