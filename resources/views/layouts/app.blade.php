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
        }

        .floating-icon {
            animation: float 6s ease-in-out infinite;
        }

        .notification-ping {
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        /* Scrollbar personalizado */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
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
            :class="sidebarOpen ? 'left-64' : 'left-24'" 
            :style="'right: 0'">
        <div class="flex items-center justify-between px-6 py-4">
            <!-- Left side - Menu button and Logo -->
            <div class="flex items-center space-x-4">
                <!-- Sidebar toggle button -->
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="p-2.5 rounded-lg bg-primary-800 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-accent-500 transition-all duration-200 group">
                    <i class="fas fa-bars text-primary-200 group-hover:text-white text-sm"></i>
                </button>
                
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 bg-accent-600 rounded-lg flex items-center justify-center floating-icon">
                        <i class="fas fa-cube text-white text-base"></i>
                    </div>
                    <h1 class="text-xl font-bold text-white hidden sm:block">BoxWare</h1>
                </div>
            </div>

            <!-- Right side - User menu and notifications -->
            <div class="flex items-center space-x-3">
                <!-- Notifications -->
                <button class="relative p-2.5 rounded-lg bg-primary-800 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-accent-500 transition-all duration-200 group">
                    <i class="fas fa-bell text-primary-200 group-hover:text-white text-sm"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium notification-ping">3</span>
                </button>

                <!-- User dropdown -->
                <div class="relative" x-data="{ userMenuOpen: false }">
                    <button @click="userMenuOpen = !userMenuOpen" 
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-full sidebar-gradient shadow-2xl transition-all duration-500 ease-in-out z-30 custom-scrollbar overflow-y-auto border-r border-primary-700"
           :class="sidebarOpen ? 'w-64' : 'w-24'" 
           x-data="{ activeSubmenu: null }">
        
        <!-- Sidebar header -->
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
                </div>
            </div>
        </div>

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
                            Inicio
                        </div>
                    </a>
                </li>

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
                            Administración
                        </div>
                    </button>
                    
                    <!-- Submenu Administración -->
                    <div x-show="sidebarOpen && activeSubmenu === 'inventory'" 
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
                            </div>
                            Módulos
                        </a>
                    </div>
                </li>

                <!-- Inventario -->
                <li>
                    <button @click="activeSubmenu = activeSubmenu === 'movements' ? null : 'movements'" 
                            class="flex items-center w-full px-3 py-2.5 text-primary-200 hover:text-white rounded-lg transition-all duration-200 group menu-item-hover">
                        <div class="w-8 h-8 bg-primary-700 rounded-lg flex items-center justify-center group-hover:bg-accent-600 transition-colors duration-200" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">
                            <i class="fas fa-boxes text-sm"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-medium flex-1 text-left">Inventario</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down text-xs transition-transform duration-200" :class="activeSubmenu === 'movements' ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-16 glass-effect text-white px-3 py-2 rounded-lg text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
                            Inventario
                        </div>
                    </button>
                    
                    <!-- Submenu Inventario -->
                    <div x-show="sidebarOpen && activeSubmenu === 'movements'" 
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
                    </div>
                </li>   

                <!-- Ubicaciones -->
                <li>
                    <button @click="submenus.ubicaciones = !submenus.ubicaciones" 
                            class="flex items-center w-full px-3 py-2.5 text-primary-200 hover:text-white rounded-lg transition-all duration-200 group menu-item-hover">
                        <div class="w-8 h-8 bg-primary-700 rounded-lg flex items-center justify-center group-hover:bg-accent-600 transition-colors duration-200" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-medium flex-1 text-left">Ubicaciones</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down text-xs transition-transform duration-200" :class="submenus.ubicaciones ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-16 glass-effect text-white px-3 py-2 rounded-lg text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
                            Ubicaciones
                        </div>
                    </button>
                    
                    <!-- Submenu Ubicaciones -->
                    <div x-show="sidebarOpen && submenus.ubicaciones" 
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
                            </div>
                            Tipos de Sitios
                        </a>
                    </div>
                </li>

                <!-- Educación -->
                <li>
                    <button @click="submenus.educacion = !submenus.educacion" 
                            class="flex items-center w-full px-3 py-2.5 text-primary-200 hover:text-white rounded-lg transition-all duration-200 group menu-item-hover">
                        <div class="w-8 h-8 bg-primary-700 rounded-lg flex items-center justify-center group-hover:bg-accent-600 transition-colors duration-200" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">
                            <i class="fas fa-graduation-cap text-sm"></i>
                        </div>
                        <span x-show="sidebarOpen" x-transition class="font-medium flex-1 text-left">Educación</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down text-xs transition-transform duration-200" :class="submenus.educacion ? 'rotate-180' : ''"></i>
                        <div x-show="!sidebarOpen" class="absolute left-16 glass-effect text-white px-3 py-2 rounded-lg text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none whitespace-nowrap z-50">
                            Educación
                        </div>
                    </button>
                    
                    <!-- Submenu Educación -->
                    <div x-show="sidebarOpen && submenus.educacion" 
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
          :class="sidebarOpen ? 'ml-64' : 'ml-24'" 
          style="padding-top: 90px;">
        <div class="p-8">
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
         class="fixed inset-0 bg-primary-900 bg-opacity-75 z-20 md:hidden backdrop-blur-sm"></div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @yield('scripts')
</body>
</html>