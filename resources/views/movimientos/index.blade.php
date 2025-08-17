@extends('layouts.app')

@section('title', 'Movimientos | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Movimientos</h1>
        <p class="text-primary-300">Administra los movimientos de inventario del sistema BoxWare</p>
    </div>
    <a href="{{ route('movimientos.create') }}" 
       class="flex items-center space-x-2 bg-accent-600 hover:bg-accent-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-plus text-sm"></i>
        <span>Nuevo Movimiento</span>
    </a>
</div>

<!-- Content Section -->
<div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
    @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
        {{ session('error') }}
    </div>
    @endif
    <!-- Table Header -->
    <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-exchange-alt text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">Lista de Movimientos</h3>
                <p class="text-primary-300 text-sm">{{ count($movimientos) }} movimientos registrados</p>
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
                        <th class="pb-4 font-semibold">Tipo</th>
                        <th class="pb-4 font-semibold">Material</th>
                        <th class="pb-4 font-semibold">Cantidad</th>
                        <th class="pb-4 font-semibold">Sitio Origen</th>
                        <th class="pb-4 font-semibold">Sitio Destino</th>
                        <th class="pb-4 font-semibold">Usuario</th>
                        <th class="pb-4 font-semibold">Fecha</th>
                        <th class="pb-4 font-semibold">Estado</th>
                        <th class="pb-4 font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movimientos as $movimiento)
                        <tr class="border-b border-primary-700 hover:bg-primary-800 hover:bg-opacity-50 transition-colors duration-200">
                            <td class="py-4 text-white">{{ $movimiento->id_movimiento }}</td>
                            <td class="py-4 text-white">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    @if($movimiento->tipoMovimiento->tipo_movimiento == 'Entrada')
                                        bg-emerald-900 text-emerald-300
                                    @elseif($movimiento->tipoMovimiento->tipo_movimiento == 'Salida')
                                        bg-rose-900 text-rose-300
                                    @elseif($movimiento->tipoMovimiento->tipo_movimiento == 'Traslado')
                                        bg-sky-900 text-sky-300
                                    @else
                                        bg-amber-900 text-amber-300
                                    @endif
                                ">
                                    {{ $movimiento->tipoMovimiento->tipo_movimiento }}
                                </span>
                            </td>
                            <td class="py-4 text-white">{{ $movimiento->material->nombre_material ?? 'N/A' }}</td>
                            <td class="py-4 text-white">{{ $movimiento->cantidad }}</td>
                            <td class="py-4 text-white">
                                @if(in_array(strtolower($movimiento->tipoMovimiento->tipo_movimiento), ['traslado', 'prestamo', 'préstamo', 'devolucion', 'devolución']))
                                    {{ $movimiento->sitioOrigen->nombre_sitio ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="py-4 text-white">
                                @if(in_array(strtolower($movimiento->tipoMovimiento->tipo_movimiento), ['traslado', 'prestamo', 'préstamo', 'devolucion', 'devolución']))
                                    {{ $movimiento->sitioDestino->nombre_sitio ?? 'N/A' }}
                                @else
                                    {{ $movimiento->sitio->nombre_sitio ?? 'N/A' }}
                                @endif
                            </td>
                            <td class="py-4 text-white">{{ $movimiento->usuarioMovimiento->nombre ?? 'N/A' }}</td>
                            <td class="py-4 text-white">{{ date('d/m/Y', strtotime($movimiento->fecha_creacion)) }}</td>
                            <td class="py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $movimiento->estado ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' }}">
                                    {{ $movimiento->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('movimientos.edit', $movimiento->id_movimiento) }}" 
                                       class="p-2 bg-primary-700 hover:bg-primary-600 rounded-lg text-primary-300 hover:text-white transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="py-6 text-center text-primary-300">
                                <div class="flex flex-col items-center justify-center space-y-4">
                                    <div class="w-16 h-16 bg-primary-800 rounded-full flex items-center justify-center">
                                        <i class="fas fa-exchange-alt text-primary-600 text-2xl"></i>
                                    </div>
                                    <p>No hay movimientos registrados</p>
                                    <a href="{{ route('movimientos.create') }}" class="text-accent-500 hover:text-accent-400 transition-colors duration-200">
                                        Registrar un nuevo movimiento
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