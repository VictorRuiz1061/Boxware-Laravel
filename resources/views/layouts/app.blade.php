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
<<<<<<< HEAD
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
=======
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                        accent: {
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
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
<<<<<<< HEAD
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
=======
        body {
            background-color: #0f172a;
        }   
        
        .glass-effect {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(71, 85, 105, 0.3);
        }
        
        .glass-effect-header {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(71, 85, 105, 0.2);
        }
        
        .sidebar-gradient {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
        }

        .menu-item-hover {
            transition: all 0.2s ease;
        }

        .menu-item-hover:hover {
            transform: translateX(4px);
            background: rgba(59, 130, 246, 0.1);
        }

        .submenu-item-hover {
            transition: all 0.2s ease;
        }

        .submenu-item-hover:hover {
            transform: translateX(2px);
            background: rgba(59, 130, 246, 0.08);
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
        }

        .floating-icon {
            animation: float 6s ease-in-out infinite;
        }

        .notification-ping {
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        /* Scrollbar personalizado */
        .custom-scrollbar::-webkit-scrollbar {
<<<<<<< HEAD
            width: 6px;
=======
            width: 4px;
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
<<<<<<< HEAD
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
=======
            background: rgba(71, 85, 105, 0.5);
            border-radius: 2px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(71, 85, 105, 0.7);
        }

        .menu-separator {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(71, 85, 105, 0.3) 50%, transparent 100%);
            margin: 0.5rem 0;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-primary-900 min-h-screen" x-data="{ sidebarOpen: true, mobileMenuOpen: false, submenus: { ubicaciones: false, educacion: false } }">
    <!-- Header -->
    <header class="glass-effect-header shadow-lg fixed top-0 z-40 transition-all duration-500 ease-in-out"
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
            :class="sidebarOpen ? 'left-64' : 'left-24'" 
            :style="'right: 0'">
        <div class="flex items-center justify-between px-6 py-4">
            <!-- Left side - Menu button and Logo -->
            <div class="flex items-center space-x-4">
                <!-- Sidebar toggle button -->
                <button @click="sidebarOpen = !sidebarOpen" 
<<<<<<< HEAD
                        class="p-3 rounded-xl glass-effect-dark hover:bg-white hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300 group">
                    <i class="fas fa-bars text-white group-hover:scale-110 transition-transform duration-200"></i>
=======
                        class="p-2.5 rounded-lg bg-primary-800 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-accent-500 transition-all duration-200 group">
                    <i class="fas fa-bars text-primary-200 group-hover:text-white text-sm"></i>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                </button>
                
                <!-- Logo -->
                <div class="flex items-center space-x-3">
<<<<<<< HEAD
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-xl flex items-center justify-center floating-icon">
                        <i class="fas fa-cube text-white text-lg"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-purple-200 hidden sm:block">BoxWare</h1>
=======
                    <div class="w-9 h-9 bg-accent-600 rounded-lg flex items-center justify-center floating-icon">
                        <i class="fas fa-cube text-white text-base"></i>
                    </div>
                    <h1 class="text-xl font-bold text-white hidden sm:block">BoxWare</h1>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                </div>
            </div>

            <!-- Right side - User menu and notifications -->
<<<<<<< HEAD
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <button class="relative p-3 rounded-xl glass-effect-dark hover:bg-white hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300 group">
                    <i class="fas fa-bell text-white group-hover:scale-110 transition-transform duration-200"></i>
                    <span class="absolute -top-1 -right-1 bg-gradient-to-r from-red-400 to-pink-500 text-white text-xs rounded-full h-6 w-6 flex items-center justify-center font-semibold notification-ping">3</span>
=======
            <div class="flex items-center space-x-3">
                <!-- Notifications -->
                <button class="relative p-2.5 rounded-lg bg-primary-800 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-accent-500 transition-all duration-200 group">
                    <i class="fas fa-bell text-primary-200 group-hover:text-white text-sm"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium notification-ping">3</span>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                </button>

                <!-- User dropdown -->
                <div class="relative" x-data="{ userMenuOpen: false }">
                    <button @click="userMenuOpen = !userMenuOpen" 
<<<<<<< HEAD
                            class="flex items-center space-x-3 p-3 rounded-xl glass-effect-dark hover:bg-white hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300 group">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">VR</span>
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-semibold text-white">Victor Ruiz</div>
                            <div class="text-xs text-blue-200">Administrador</div>
                        </div>
                        <i class="fas fa-chevron-down text-blue-200 text-sm group-hover:rotate-180 transition-transform duration-300"></i>
=======
                            class="flex items-center w-full px-3 py-2.5 text-primary-200 hover:text-white rounded-lg transition-all duration-200 group">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center">
                            @if(session('usuario_id') && session('usuario_imagen') && Storage::disk('public')->exists(session('usuario_imagen')))
                                <img src="{{ Storage::url(session('usuario_imagen')) }}" alt="{{ session('usuario_nombre') }}" class="w-8 h-8 rounded-lg object-cover">
                            @else
                                <span class="text-white font-medium text-xs">{{ session('usuario_nombre') ? substr(session('usuario_nombre'), 0, 2) : 'US' }}</span>
                            @endif
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-medium text-white">{{ session('usuario_nombre') ?? 'Usuario' }}</div>
                            <div class="text-xs text-primary-300">{{ session('usuario_rol') ?? 'Sin rol' }}</div>
                        </div>
                        <i class="fas fa-chevron-down text-primary-300 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
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
<<<<<<< HEAD
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
=======
                         class="absolute right-0 mt-2 w-56 glass-effect rounded-lg shadow-xl py-2 z-50">
                        <div class="px-4 py-3 border-b border-primary-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-accent-600 rounded-lg flex items-center justify-center">
                                    @if(session('usuario_id') && session('usuario_imagen') && Storage::disk('public')->exists(session('usuario_imagen')))
                                        <img src="{{ Storage::url(session('usuario_imagen')) }}" alt="{{ session('usuario_nombre') }}" class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <span class="text-white font-medium">{{ session('usuario_nombre') ? substr(session('usuario_nombre'), 0, 2) : 'US' }}</span>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">{{ session('usuario_nombre') ?? 'Usuario' }}</p>
                                    <p class="text-xs text-primary-400">{{ session('usuario_email') ?? 'email@boxware.com' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('usuarios.perfil') }}" class="flex items-center px-4 py-2 text-sm text-primary-200 hover:bg-primary-700 transition-colors duration-200 group">
                                <i class="fas fa-user mr-3 text-accent-500 text-xs"></i>Mi Perfil
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-primary-200 hover:bg-primary-700 transition-colors duration-200 group">
                                <i class="fas fa-question-circle mr-3 text-accent-500 text-xs"></i>Notificaciones
                            </a>
                        </div>
                        <div class="border-t border-primary-700 pt-1">
                            <form method="POST" action="{{ route('logout.web') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-400 hover:bg-red-500 hover:bg-opacity-10 transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt mr-3 text-xs"></i>Cerrar Sesión
                                </button>
                            </form>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
<<<<<<< HEAD
    <aside class="fixed left-0 top-0 h-full sidebar-gradient shadow-2xl transition-all duration-500 ease-in-out z-30 custom-scrollbar overflow-y-auto"
=======
    <aside class="fixed left-0 top-0 h-full sidebar-gradient shadow-2xl transition-all duration-500 ease-in-out z-30 custom-scrollbar overflow-y-auto border-r border-primary-700"
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
           :class="sidebarOpen ? 'w-64' : 'w-24'" 
           x-data="{ activeSubmenu: null }">
        
        <!-- Sidebar header -->
<<<<<<< HEAD
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
=======
        <div class="flex items-center px-4 py-6" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
            <div class="flex items-center" x-show="sidebarOpen" x-transition>
                <div class="text-center w-full">
                    <h1 class="text-white font-bold text-xl tracking-wide">BoxWare</h1>
                    <p class="text-primary-400 text-xs mt-1">Sistema de Inventario</p>
                </div>
            </div>
            <div x-show="!sidebarOpen" class="text-white">
                <div class="w-10 h-10 bg-accent-600 rounded-lg flex items-center justify-center floating-icon">
                    <i class="fas fa-cube text-white text-lg"></i>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                </div>
            </div>
        </div>

<<<<<<< HEAD
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
=======
        <div class="menu-separator mx-4"></div>

        <!-- Navigation -->
        <nav class="px-3 pb-6">
            <ul class="space-y-1">
                <!-- Dashboard -->
                <li>
                    <a href="{{ url('/dashboard') }}" class="flex items-center px-3 py-2.5 text-primary-200 hover:text-white rounded-lg transition-all duration-200 group menu-item-hover">
                        <div class="w-8 h-8 bg-primary-700 rounded-lg flex items-center justify-center group-hover:bg-accent-600 transition-colors duration-200" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">
                            <i class="fas fa-tachometer-alt text-sm"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-medium">Inicio</span>
                        <div x-show="!sidebarOpen" class="absolute left-16 glass-effect text-white px-3 py-2 rounded-lg text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                            Inicio
                        </div>
                    </a>
                </li>

<<<<<<< HEAD
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
=======
                <div class="menu-separator mx-2 my-2"></div>

                <!-- Administración -->
                <li>
                    <button @click="activeSubmenu = activeSubmenu === 'inventory' ? null : 'inventory'" 
                            class="flex items-center w-full px-3 py-2.5 text-primary-200 hover:text-white rounded-lg transition-all duration-200 group menu-item-hover">
                        <div class="w-8 h-8 bg-primary-700 rounded-lg flex items-center justify-center group-hover:bg-accent-600 transition-colors duration-200" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">
                            <i class="fas fa-users-cog text-sm"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-medium flex-1 text-left">Administración</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down text-xs transition-transform duration-200" :class="activeSubmenu === 'inventory' ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-16 glass-effect text-white px-3 py-2 rounded-lg text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                            Administración
                        </div>
                    </button>
                    
                    <!-- Submenu Administración -->
                    <div x-show="sidebarOpen && activeSubmenu === 'inventory'" 
<<<<<<< HEAD
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
=======
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="ml-4 mt-1 space-y-0.5 border-l-2 border-primary-700 pl-3">
                        <a href="{{ url('/usuarios') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-users text-xs"></i>
                            </div>
                            Usuarios
                        </a>
                        <a href="{{ url('/roles') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-user-shield text-xs"></i>
                            </div>
                            Roles
                        </a>
                        <a href="{{ url('/permisos') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-key text-xs"></i>
                            </div>
                            Permisos
                        </a>
                        <a href="{{ url('/modulos') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-puzzle-piece text-xs"></i>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                            </div>
                            Módulos
                        </a>
                    </div>
                </li>

                <!-- Inventario -->
                <li>
                    <button @click="activeSubmenu = activeSubmenu === 'movements' ? null : 'movements'" 
<<<<<<< HEAD
                            class="flex items-center w-full px-4 py-4 text-white font-semibold hover:bg-white hover:bg-opacity-10 rounded-2xl transition-all duration-300 group menu-item-hover">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-400 to-pink-500 rounded-xl flex items-center justify-center" :class="sidebarOpen ? 'mr-4' : 'mx-auto'">
                            <i class="fas fa-exchange-alt text-white group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-semibold flex-1 text-left">Inventario</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down transition-transform duration-300" :class="activeSubmenu === 'movements' ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-20 glass-effect text-white px-3 py-2 rounded-xl text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
=======
                            class="flex items-center w-full px-3 py-2.5 text-primary-200 hover:text-white rounded-lg transition-all duration-200 group menu-item-hover">
                        <div class="w-8 h-8 bg-primary-700 rounded-lg flex items-center justify-center group-hover:bg-accent-600 transition-colors duration-200" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">
                            <i class="fas fa-boxes text-sm"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-medium flex-1 text-left">Inventario</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down text-xs transition-transform duration-200" :class="activeSubmenu === 'movements' ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-16 glass-effect text-white px-3 py-2 rounded-lg text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                            Inventario
                        </div>
                    </button>
                    
                    <!-- Submenu Inventario -->
                    <div x-show="sidebarOpen && activeSubmenu === 'movements'" 
<<<<<<< HEAD
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
=======
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="ml-4 mt-1 space-y-0.5 border-l-2 border-primary-700 pl-3">
                        <a href="{{ url('/materiales') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-box text-xs"></i>
                            </div>
                            Materiales
                        </a>
                        <a href="{{ url('/categorias_elementos') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-layer-group text-xs"></i>
                            </div>
                            Categorías de Elemento
                        </a>
                        <a href="{{ url('/tipo_material') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-tags text-xs"></i>
                            </div>
                            Tipos de Material
                        </a>
                        <a href="{{ url('/movimientos') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-exchange-alt text-xs"></i>
                            </div>
                            Movimientos
                        </a>
                        <a href="{{ url('/tipo_movimiento') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-list-ul text-xs"></i>
                            </div>
                            Tipo de Movimientos
                        </a>
                        <a href="{{ url('/inventario') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-clipboard-list text-xs"></i>
                            </div>
                            Inventario
                        </a>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                    </div>
                </li>   

                <!-- Ubicaciones -->
                <li>
                    <button @click="submenus.ubicaciones = !submenus.ubicaciones" 
<<<<<<< HEAD
                            class="flex items-center w-full px-4 py-4 text-white font-semibold hover:bg-white hover:bg-opacity-10 rounded-2xl transition-all duration-300 group menu-item-hover">
                        <div class="w-10 h-10 bg-gradient-to-r from-red-400 to-pink-500 rounded-xl flex items-center justify-center" :class="sidebarOpen ? 'mr-4' : 'mx-auto'">
                            <i class="fas fa-map-marker-alt text-white group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-semibold flex-1 text-left">Ubicaciones</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down transition-transform duration-300" :class="submenus.ubicaciones ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-20 glass-effect text-white px-3 py-2 rounded-xl text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
=======
                            class="flex items-center w-full px-3 py-2.5 text-primary-200 hover:text-white rounded-lg transition-all duration-200 group menu-item-hover">
                        <div class="w-8 h-8 bg-primary-700 rounded-lg flex items-center justify-center group-hover:bg-accent-600 transition-colors duration-200" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-medium flex-1 text-left">Ubicaciones</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down text-xs transition-transform duration-200" :class="submenus.ubicaciones ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-16 glass-effect text-white px-3 py-2 rounded-lg text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                            Ubicaciones
                        </div>
                    </button>
                    
                    <!-- Submenu Ubicaciones -->
                    <div x-show="sidebarOpen && submenus.ubicaciones" 
<<<<<<< HEAD
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
                        <a href="#" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
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
=======
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="ml-4 mt-1 space-y-0.5 border-l-2 border-primary-700 pl-3">
                        <a href="{{ url('/sede') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-building text-xs"></i>
                            </div>
                            Sedes
                        </a>
                        <a href="{{ url('/centro') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-home text-xs"></i>
                            </div>
                            Centros
                        </a>
                        <a href="{{ url('/municipios') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-city text-xs"></i>
                            </div>
                            Municipios
                        </a>
                        <a href="{{ url('/areas') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-map text-xs"></i>
                            </div>
                            Áreas
                        </a>
                        <a href="{{ url('/sitios') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-location-dot text-xs"></i>
                            </div>
                            Sitios
                        </a>
                        <a href="{{ url('/tipos_sitio') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-tags text-xs"></i>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                            </div>
                            Tipos de Sitios
                        </a>
                    </div>
                </li>

                <!-- Educación -->
                <li>
                    <button @click="submenus.educacion = !submenus.educacion" 
<<<<<<< HEAD
                            class="flex items-center w-full px-4 py-4 text-white font-semibold hover:bg-white hover:bg-opacity-10 rounded-2xl transition-all duration-300 group menu-item-hover">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-400 to-blue-500 rounded-xl flex items-center justify-center" :class="sidebarOpen ? 'mr-4' : 'mx-auto'">
                            <i class="fas fa-graduation-cap text-white group-hover:scale-110 transition-transform duration-200"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-semibold flex-1 text-left">Educación</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down transition-transform duration-300" :class="submenus.educacion ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-20 glass-effect text-white px-3 py-2 rounded-xl text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
=======
                            class="flex items-center w-full px-3 py-2.5 text-primary-200 hover:text-white rounded-lg transition-all duration-200 group menu-item-hover">
                        <div class="w-8 h-8 bg-primary-700 rounded-lg flex items-center justify-center group-hover:bg-accent-600 transition-colors duration-200" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">
                            <i class="fas fa-graduation-cap text-sm"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-medium flex-1 text-left">Educación</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down text-xs transition-transform duration-200" :class="submenus.educacion ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-16 glass-effect text-white px-3 py-2 rounded-lg text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                            Educación
                        </div>
                    </button>
                    
                    <!-- Submenu Educación -->
                    <div x-show="sidebarOpen && submenus.educacion" 
<<<<<<< HEAD
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="ml-6 mt-3 space-y-2">
                        <a href="#" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-amber-400 to-yellow-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-file-alt text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
                            </div>
                            Fichas
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-blue-100 font-medium hover:bg-white hover:bg-opacity-10 rounded-xl text-sm transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-lime-400 to-green-400 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-book text-white text-xs group-hover:scale-110 transition-transform duration-200"></i>
=======
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="ml-4 mt-1 space-y-0.5 border-l-2 border-primary-700 pl-3">
                        <a href="{{ url('/fichas') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-file-alt text-xs"></i>
                            </div>
                            Fichas
                        </a>
                        <a href="{{ url('/programas') }}" class="flex items-center px-3 py-2 text-primary-300 hover:text-white rounded-md text-sm transition-all duration-200 submenu-item-hover">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center mr-3 group-hover:bg-accent-600 transition-colors duration-200">
                                <i class="fas fa-book text-xs"></i>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
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
<<<<<<< HEAD
          :class="sidebarOpen ? 'ml-64' : 'ml-16'" 
          style="padding-top: 90px;">
        <div class="p-8">
            <!-- Content area with glass effect -->
             @yield('content')
=======
          :class="sidebarOpen ? 'ml-64' : 'ml-24'" 
          style="padding-top: 90px;">
        <div class="p-8">
            @yield('content')
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
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
<<<<<<< HEAD
         class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 md:hidden backdrop-blur-sm"></div>

    <!-- Floating Action Button -->
    <div class="fixed bottom-8 right-8 z-30">
        <button class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full shadow-2xl flex items-center justify-center text-white hover:shadow-3xl transition-all duration-300 hover:scale-110 floating-icon">
            <i class="fas fa-plus text-xl"></i>
        </button>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
=======
         class="fixed inset-0 bg-primary-900 bg-opacity-75 z-20 md:hidden backdrop-blur-sm"></div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @yield('scripts')
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
</body>
</html>