@extends('layouts.app')

@section('title', 'Dashboard | BoxWare')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white">Hola, {{ $usuario->nombre }}!</h1>
            <p class="text-primary-300">Bienvenido de nuevo a tu dashboard.</p>
        </div>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="glass-effect p-6 rounded-2xl border border-primary-700 flex items-center space-x-6 hover:border-accent-500 transition-all duration-300">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-users text-white text-2xl"></i>
            </div>
            <div>
                <p class="text-primary-300 text-sm font-medium">Total Usuarios</p>
                <p class="text-3xl font-bold text-white">{{ $totalUsuarios }}</p>
            </div>
        </div>
        <div class="glass-effect p-6 rounded-2xl border border-primary-700 flex items-center space-x-6 hover:border-accent-500 transition-all duration-300">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-box-open text-white text-2xl"></i>
            </div>
            <div>
                <p class="text-primary-300 text-sm font-medium">Total Materiales</p>
                <p class="text-3xl font-bold text-white">{{ $totalMateriales }}</p>
            </div>
        </div>
        <div class="glass-effect p-6 rounded-2xl border border-primary-700 flex items-center space-x-6 hover:border-accent-500 transition-all duration-300">
            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-exchange-alt text-white text-2xl"></i>
            </div>
            <div>
                <p class="text-primary-300 text-sm font-medium">Total Movimientos</p>
                <p class="text-3xl font-bold text-white">{{ $totalMovimientos }}</p>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">
        <div class="lg:col-span-3 glass-effect p-6 rounded-2xl border border-primary-700">
            <h2 class="text-xl font-bold text-white mb-4">Movimientos en los últimos 7 días</h2>
            <div class="relative h-80">
                <canvas id="movimientosChart"></canvas>
            </div>
        </div>
        <div class="lg:col-span-2 glass-effect p-6 rounded-2xl border border-primary-700">
            <h2 class="text-xl font-bold text-white mb-4">Stock por Sitio</h2>
            <div class="relative h-80">
                <canvas id="stockChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Movements -->
    <div class="glass-effect rounded-2xl border border-primary-700 overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-bold text-white mb-4">Movimientos Recientes</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-primary-300 uppercase tracking-wider">Material</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-primary-300 uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-primary-300 uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-primary-300 uppercase tracking-wider">Ubicación</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-primary-300 uppercase tracking-wider">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($movimientosRecientes as $movimiento)
                            <tr class="border-b border-primary-700 hover:bg-primary-800 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-white font-medium">{{ $movimiento->material->nombre_material }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background-color: {{ $movimiento->tipoMovimiento->color ?? '#ffffff' }}20; color: {{ $movimiento->tipoMovimiento->color ?? '#ffffff' }};">
                                        {{ $movimiento->tipoMovimiento->tipo_movimiento }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-white font-semibold">{{ $movimiento->cantidad }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-primary-300 text-sm">
                                    <div class="flex items-center">
                                        <span class="text-green-400">{{ $movimiento->sitioOrigen->nombre_sitio ?? 'N/A' }}</span>
                                        <i class="fas fa-arrow-right text-primary-400 mx-2"></i>
                                        <span class="text-red-400">{{ $movimiento->sitioDestino->nombre_sitio ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-primary-300 text-sm">{{ $movimiento->fecha_creacion->format('d M, Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-primary-400">No hay movimientos recientes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Chart.defaults.color = '#94a3b8';
        Chart.defaults.borderColor = 'rgba(71, 85, 105, 0.5)';

        // Chart de Movimientos
        var ctxMovimientos = document.getElementById('movimientosChart').getContext('2d');
        var gradient = ctxMovimientos.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.5)');
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

        var movimientosChart = new Chart(ctxMovimientos, {
            type: 'line',
            data: {
                labels: {!! json_encode($fechas) !!},
                datasets: [{
                    label: 'Movimientos',
                    data: {!! json_encode($totales) !!},
                    backgroundColor: gradient,
                    borderColor: '#3b82f6',
                    borderWidth: 2,
                    pointBackgroundColor: '#3b82f6',
                    pointRadius: 4,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(71, 85, 105, 0.5)' }
                    }
                }
            }
        });

        // Chart de Stock
        var ctxStock = document.getElementById('stockChart').getContext('2d');
        var stockChart = new Chart(ctxStock, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($nombresSitios) !!},
                datasets: [{
                    label: 'Stock Total',
                    data: {!! json_encode($stocks) !!},
                    backgroundColor: [
                        '#1d4ed8', '#2563eb', '#3b82f6', '#60a5fa', '#93c5fd', '#bfdbfe'
                    ],
                    borderColor: '#0f172a',
                    borderWidth: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    });
</script>
@endsection
