<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoxWare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            50: '#fdf4ff',
                            100: '#fae8ff',
                            200: '#f5d0fe',
                            300: '#f0abfc',
                            400: '#e879f9',
                            500: '#d946ef',
                            600: '#c026d3',
                            700: '#a21caf',
                            800: '#86198f',
                            900: '#701a75',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s infinite',
                        'slide-down': 'slide-down 0.3s ease-out',
                        'slide-up': 'slide-up 0.3s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        'slide-down': {
                            '0%': { opacity: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0px)' },
                        },
                        'slide-up': {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0px)' },
                        }
                        
                    },
                    backdropBlur: {
                        xs: '2px',
                    }
                }
            }
        }
    </script>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .glass-effect-dark {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .gradient-border {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2px;
            border-radius: 12px;
        }
        
        .gradient-border-content {
            background: white;
            border-radius: 10px;
        }

        .sidebar-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .header-gradient {
            background: linear-gradient(135deg, #2D3748 0%, #1A202C 100%);
        }

        .menu-item-hover {
            transition: all 0.3s ease;
        }

        .menu-item-hover:hover {
            transform: translateX(8px) scale(1.02);
        }

        .floating-icon {
            animation: float 6s ease-in-out infinite;
        }

        .notification-ping {
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        /* Scrollbar personalizado */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen" x-data="{ sidebarOpen: true, mobileMenuOpen: false, submenus: { ubicaciones: false, educacion: false } }">
    <!-- Header -->
    <header class="header-gradient shadow-2xl border-b border-gray-700 fixed top-0 z-40 transition-all duration-500 ease-in-out"
            :class="sidebarOpen ? 'left-64' : 'left-24'" 
            :style="'right: 0'">
        <div class="flex items-center justify-between px-6 py-4">
            <!-- Left side - Menu button and Logo -->
            <div class="flex items-center space-x-4">
                <!-- Sidebar toggle button -->
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="p-3 rounded-xl glass-effect-dark hover:bg-white hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300 group">
                    <i class="fas fa-bars text-white group-hover:scale-110 transition-transform duration-200"></i>
                </button>
                
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-xl flex items-center justify-center floating-icon">
                        <i class="fas fa-cube text-white text-lg"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-purple-200 hidden sm:block">BoxWare</h1>
                </div>
            </div>

            <!-- Right side - User menu and notifications -->
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <button class="relative p-3 rounded-xl glass-effect-dark hover:bg-white hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300 group">
                    <i class="fas fa-bell text-white group-hover:scale-110 transition-transform duration-200"></i>
                    <span class="absolute -top-1 -right-1 bg-gradient-to-r from-red-400 to-pink-500 text-white text-xs rounded-full h-6 w-6 flex items-center justify-center font-semibold notification-ping">3</span>
                </button>

                <!-- User dropdown -->
                <div class="relative" x-data="{ userMenuOpen: false }">
                    <button @click="userMenuOpen = !userMenuOpen" 
                            class="flex items-center space-x-3 p-3 rounded-xl glass-effect-dark hover:bg-white hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300 group">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">VR</span>
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-semibold text-white">Victor Ruiz</div>
                            <div class="text-xs text-blue-200">Administrador</div>
                        </div>
                        <i class="fas fa-chevron-down text-blue-200 text-sm group-hover:rotate-180 transition-transform duration-300"></i>
                    </button>
                    
                    <!-- User dropdown menu -->
                    <div x-show="userMenuOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="transform opacity-0 scale-95 translate-y-2"
                         x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="transform opacity-0 scale-95 translate-y-2"
                         @click.away="userMenuOpen = false" 
                         class="absolute right-0 mt-3 w-64 glass-effect rounded-2xl shadow-2xl border border-white border-opacity-20 py-2 z-50">
                        <div class="px-6 py-4 border-b border-white border-opacity-10">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">VR</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Victor Ruiz</p>
                                    <p class="text-xs text-gray-600">victor@boxware.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <a href="#" class="flex items-center px-6 py-3 text-sm text-gray-700 hover:bg-white hover:bg-opacity-50 transition-all duration-200 group">
                                <i class="fas fa-user mr-4 text-blue-500 group-hover:scale-110 transition-transform duration-200"></i>Mi Perfil
                            </a>
                            <a href="#" class="flex items-center px-6 py-3 text-sm text-gray-700 hover:bg-white hover:bg-opacity-50 transition-all duration-200 group">
                                <i class="fas fa-cog mr-4 text-purple-500 group-hover:scale-110 transition-transform duration-200"></i>Configuración
                            </a>
                            <a href="#" class="flex items-center px-6 py-3 text-sm text-gray-700 hover:bg-white hover:bg-opacity-50 transition-all duration-200 group">
                                <i class="fas fa-question-circle mr-4 text-green-500 group-hover:scale-110 transition-transform duration-200"></i>Ayuda
                            </a>
                        </div>
                        <div class="border-t border-white border-opacity-10 pt-2">
                            <button class="flex items-center w-full px-6 py-3 text-sm text-red-600 hover:bg-red-50 hover:bg-opacity-50 transition-all duration-200 group">
                                <i class="fas fa-sign-out-alt mr-4 group-hover:scale-110 transition-transform duration-200"></i>Cerrar Sesión
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-full sidebar-gradient shadow-2xl transition-all duration-500 ease-in-out z-30 custom-scrollbar overflow-y-auto"
           :class="sidebarOpen ? 'w-64' : 'w-24'" 
           x-data="{ activeSubmenu: null }">
        
        <!-- Sidebar header -->
        <div class="flex items-center px-6 py-8" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
            <div class="flex items-center" x-show="sidebarOpen" x-transition>
                <div class="glass-effect rounded-2xl p-6 backdrop-blur-sm w-full">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-white to-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-3 floating-icon">
                            <i class="fas fa-cube text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-white font-bold text-2xl tracking-wide">Boxware</h3>
                        <p class="text-blue-100 text-sm mt-1">Sistema de Gestión</p>
                    </div>
                </div>
            </div>
            <div x-show="!sidebarOpen" class="text-white">
                <div class="w-10 h-10 bg-gradient-to-r from-white to-blue-100 rounded-xl flex items-center justify-center floating-icon">
                    <i class="fas fa-cube text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="px-4 pb-6">
            <ul class="space-y-3">
                <!-- Dashboard -->
                <li>
                    <a href="{{ url('/dashboard') }}" class="flex items-center px-4 py-4 text-white font-semibold glass-effect rounded-2xl hover:bg-white hover:bg-opacity-20 transition-all duration-300 group menu-item-hover">
                        <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center" :class="sidebarOpen ? 'mr-4' : 'mx-auto'">
                            <i class="fas fa-tachometer-alt text-white group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-semibold">Inicio</span>
                        <div x-show="!sidebarOpen" class="absolute left-20 glass-effect text-white px-3 py-2 rounded-xl text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
                            Inicio
                        </div>
                    </a>
                </li>

                <!-- Administración -->
                <li>
                    <button @click="activeSubmenu = activeSubmenu === 'inventory' ? null : 'inventory'" 
                            class="flex items-center w-full px-4 py-4 text-white font-semibold hover:bg-white hover:bg-opacity-10 rounded-2xl transition-all duration-300 group menu-item-hover">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-400 to-blue-500 rounded-xl flex items-center justify-center" :class="sidebarOpen ? 'mr-4' : 'mx-auto'">
                            <i class="fas fa-boxes text-white group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-semibold flex-1 text-left">Administración</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down transition-transform duration-300" :class="activeSubmenu === 'inventory' ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-20 glass-effect text-white px-3 py-2 rounded-xl text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
                            Administración
                        </div>
                    </button>
                    
                    <!-- Submenu Administración -->
                    <div x-show="sidebarOpen && activeSubmenu === 'inventory'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="ml-6 mt-3 space-y-2">
                        <a href="{{ url('/usuarios') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-users text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Usuarios
                        </a>
                        <a href="{{ url('/roles') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user-shield text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Roles
                        </a>
                        <a href="{{ url('/permisos') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-pink-400 to-red-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-key text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Permisos
                        </a>
                        <a href="{{ url('/modulos') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-teal-400 to-green-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-puzzle-piece text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Módulos
                        </a>
                    </div>
                </li>

                <!-- Inventario -->
                <li>
                    <button @click="activeSubmenu = activeSubmenu === 'movements' ? null : 'movements'" 
                            class="flex items-center w-full px-4 py-4 text-white font-semibold hover:bg-white hover:bg-opacity-10 rounded-2xl transition-all duration-300 group menu-item-hover">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-400 to-pink-500 rounded-xl flex items-center justify-center" :class="sidebarOpen ? 'mr-4' : 'mx-auto'">
                            <i class="fas fa-exchange-alt text-white group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-semibold flex-1 text-left">Inventario</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down transition-transform duration-300" :class="activeSubmenu === 'movements' ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-20 glass-effect text-white px-3 py-2 rounded-xl text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
                            Inventario
                        </div>
                    </button>
                    
                    <!-- Submenu Inventario -->
                    <div x-show="sidebarOpen && activeSubmenu === 'movements'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="ml-6 mt-3 space-y-2">
                        <a href="#" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-arrow-up text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Materiales
                        </a>
                        <a href="{{ url('/categorias_elementos') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-yellow-400 to-pink-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-layer-group text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Categorías de Elemento
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-red-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-arrow-up text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Tipo de Materiales
                        </a>
                        <a href="{{ url('/movimientos') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-violet-400 to-purple-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-history text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Movimientos
                        </a>
                        <a href="{{ url('/tipo_movimiento') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-rose-400 to-pink-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-history text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Tipo de Movimientos
                        </a>
                    </div>
                </li>   

                <!-- Ubicaciones -->
                <li>
                    <button @click="submenus.ubicaciones = !submenus.ubicaciones" 
                            class="flex items-center w-full px-4 py-4 text-white font-semibold hover:bg-white hover:bg-opacity-10 rounded-2xl transition-all duration-300 group menu-item-hover">
                        <div class="w-10 h-10 bg-gradient-to-r from-red-400 to-pink-500 rounded-xl flex items-center justify-center" :class="sidebarOpen ? 'mr-4' : 'mx-auto'">
                            <i class="fas fa-map-marker-alt text-white group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-semibold flex-1 text-left">Ubicaciones</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down transition-transform duration-300" :class="submenus.ubicaciones ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-20 glass-effect text-white px-3 py-2 rounded-xl text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
                            Ubicaciones
                        </div>
                    </button>
                    
                    <!-- Submenu Ubicaciones -->
                    <div x-show="sidebarOpen && submenus.ubicaciones" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="ml-6 mt-3 space-y-2">
                        <a href="#" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-building text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Sedes
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-emerald-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-home text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Centros
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-city text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Municipios
                        </a>
                        <a href="{{ url('/areas') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-violet-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-map text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Áreas
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-pink-400 to-rose-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-location-dot text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Sitios
                        </a>
                        <a href="{{ url('/tipos_sitio') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-teal-400 to-cyan-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-tags text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Tipos de Sitios
                        </a>
                    </div>
                </li>

                <!-- Educación -->
                <li>
                    <button @click="submenus.educacion = !submenus.educacion" 
                            class="flex items-center w-full px-4 py-4 text-white font-semibold hover:bg-white hover:bg-opacity-10 rounded-2xl transition-all duration-300 group menu-item-hover">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-400 to-blue-500 rounded-xl flex items-center justify-center" :class="sidebarOpen ? 'mr-4' : 'mx-auto'">
                            <i class="fas fa-graduation-cap text-white group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-semibold flex-1 text-left">Educación</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down transition-transform duration-300" :class="submenus.educacion ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-20 glass-effect text-white px-3 py-2 rounded-xl text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
                            Educación
                        </div>
                    </button>
                    
                    <!-- Submenu Educación -->
                    <div x-show="sidebarOpen && submenus.educacion" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="ml-6 mt-3 space-y-2">
                        <a href="{{ url('/fichas') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-amber-400 to-yellow-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-file-alt text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Fichas
                        </a>
                        <a href="{{ url('/programas') }}" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-lime-400 to-green-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-book text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Programas
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="transition-all duration-500 ease-in-out" 
          :class="sidebarOpen ? 'ml-64' : 'ml-16'" 
          style="padding-top: 90px;">
        <div class="p-8">
            <!-- Content area with glass effect -->
             @yield('content')
        </div>
    </main>

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen && window.innerWidth < 768" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 md:hidden backdrop-blur-sm"></div>

    <!-- Floating Action Button -->
    <div class="fixed bottom-8 right-8 z-30">
        <button class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full shadow-2xl flex items-center justify-center text-white hover:shadow-3xl transition-all duration-300 hover:scale-110 floating-icon">
            <i class="fas fa-plus text-xl"></i>
        </button>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>