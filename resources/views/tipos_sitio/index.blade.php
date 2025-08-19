@extends('layouts.app')

@section('title', 'Tipos de Sitio | BoxWare')

@section('content')
<<<<<<< HEAD
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Tipos de Sitio</h2>
    <a href="{{ route('tipos_sitio.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-700 transition">+ Crear Tipo de Sitio</a>
</div>
<div class="bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Nombre</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-bold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tiposSitio as $tipoSitio)
                <tr>
                    <td class="px-4 py-2">{{ $tipoSitio->id_tipo_sitio }}</td>
                    <td class="px-4 py-2">{{ $tipoSitio->nombre_tipo_sitio }}</td>
                    <td class="px-4 py-2">
                        @if($tipoSitio->estado)
                            <span class="text-green-600 font-bold">Activo</span>
                        @else
                            <span class="text-red-600 font-bold">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('tipos_sitio.edit', $tipoSitio->id_tipo_sitio) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-lg font-semibold hover:bg-yellow-500 transition mr-2">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No hay tipos de sitio registrados.</td>
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
        <h1 class="text-3xl font-bold text-white mb-2">Tipos de Sitio</h1>
        <p class="text-primary-300">Administra los tipos de sitio del sistema BoxWare</p>
    </div>
    <a href="{{ route('tipos_sitio.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-plus text-sm"></i>
        <span>Nuevo Tipo de Sitio</span>
    </a>
</div>

<!-- Content Section -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-building text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Lista de Tipos de Sitio</h3>
                <p class="text-primary-300 text-sm">{{ count($tiposSitio) }} tipos registrados</p>
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
                        <th class="pb-4 font-semibold">Nombre</th>
                        <th class="pb-4 font-semibold">Estado</th>
                        <th class="pb-4 font-semibold">Fecha Creación</th>
                        <th class="pb-4 font-semibold">Fecha Modificación</th>
                        <th class="pb-4 font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tiposSitio as $tipo)
                        <tr class="border-b border-primary-700 hover:bg-primary-800 hover:bg-opacity-50 transition-colors duration-200">
                            <td class="py-4 text-white">{{ $tipo->id_tipo_sitio }}</td>
                            <td class="py-4 text-white">{{ $tipo->nombre_tipo_sitio }}</td>
                            <td class="py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $tipo->estado ? 'bg-emerald-900 text-emerald-300' : 'bg-rose-900 text-rose-300' }}">
                                    {{ $tipo->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="py-4 text-white">{{ date('d/m/Y', strtotime($tipo->fecha_creacion)) }}</td>
                            <td class="py-4 text-white">{{ date('d/m/Y', strtotime($tipo->fecha_modificacion)) }}</td>
                            <td class="py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('tipos_sitio.edit', $tipo->id_tipo_sitio) }}" 
                                       class="p-2 bg-primary-700 hover:bg-primary-600 rounded-lg text-primary-300 hover:text-white transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-primary-300">
                                <div class="flex flex-col items-center justify-center space-y-4">
                                    <div class="w-16 h-16 bg-primary-800 rounded-full flex items-center justify-center">
                                        <i class="fas fa-building text-primary-600 text-2xl"></i>
                                    </div>
                                    <p>No hay tipos de sitio registrados</p>
                                    <a href="{{ route('tipos_sitio.create') }}" class="text-accent-500 hover:text-accent-400 transition-colors duration-200">
                                        Registrar un nuevo tipo de sitio
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
