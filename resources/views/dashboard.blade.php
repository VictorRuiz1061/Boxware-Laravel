@extends('layouts.app')

@section('title', 'Dashboard | BoxWare')

@section('content')
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                <span class="text-green-700">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="glass-effect rounded-3xl p-8 min-h-screen backdrop-blur-sm">
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl flex items-center justify-center mx-auto mb-6 floating-icon">
                        <i class="fas fa-rocket text-white text-3xl"></i>
                    </div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">¡Bienvenido a BoxWare!</h2>
                    <p class="text-xl text-gray-600 mb-8">Sistema de gestión empresarial moderno y eficiente</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-4 rounded-2xl font-semibold hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <i class="fas fa-chart-line mr-2"></i>Dashboard
                        </div>
                        <div class="bg-gradient-to-r from-green-500 to-teal-600 text-white px-8 py-4 rounded-2xl font-semibold hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <i class="fas fa-plus mr-2"></i>Nuevo Proyecto
                        </div>
                        <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white px-8 py-4 rounded-2xl font-semibold hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <i class="fas fa-cog mr-2"></i>Configurar
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl text-white hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">Total Usuarios</p>
                                <p class="text-3xl font-bold">1,234</p>
                            </div>
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-2xl text-white hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-100 text-sm font-medium">Inventario</p>
                                <p class="text-3xl font-bold">5,678</p>
                            </div>
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-boxes text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-2xl text-white hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-100 text-sm font-medium">Ubicaciones</p>
                                <p class="text-3xl font-bold">89</p>
                            </div>
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-2xl text-white hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-orange-100 text-sm font-medium">Programas</p>
                                <p class="text-3xl font-bold">45</p>
                            </div>
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')
            </div>
@endsection 