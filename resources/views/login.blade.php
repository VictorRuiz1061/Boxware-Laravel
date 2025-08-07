<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoxWare - Acceso al Sistema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#e6fffa',
                            100: '#b3f5e8',
                            200: '#81f2d5',
                            300: '#4fefc2',
                            400: '#1debaf',
                            500: '#00c896',
                            600: '#00a578',
                            700: '#00825a',
                            800: '#005f3c',
                            900: '#003c1e',
                        },
                        secondary: {
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
                        accent: {
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(16, 185, 129, 0.5)' },
                            '100%': { boxShadow: '0 0 30px rgba(16, 185, 129, 0.8)' },
                        },
                        blob: {
                            '0%': {
                                transform: 'translate(0px, 0px) scale(1)',
                            },
                            '33%': {
                                transform: 'translate(30px, -50px) scale(1.1)',
                            },
                            '66%': {
                                transform: 'translate(-20px, 20px) scale(0.9)',
                            },
                            '100%': {
                                transform: 'tranlate(0px, 0px) scale(1)',
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-morphism {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .gradient-bg {
            background: linear-gradient(-45deg, #0c4a6e, #075985, #047857, #065f46);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            top: 20%;
            right: 20%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            bottom: 20%;
            left: 10%;
            animation-delay: 4s;
        }
        
        .shape:nth-child(4) {
            bottom: 10%;
            right: 30%;
            animation-delay: 1s;
        }
        
        .particle {
            position: absolute;
            background: rgba(16, 185, 129, 0.3);
            border-radius: 50%;
            animation: float 8s linear infinite;
        }
        
        .input-glow:focus {
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
            border-color: #10b981;
        }
        
        .btn-hover {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .btn-hover:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-hover:hover:before {
            left: 100%;
        }
        
        .aurora {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at top, rgba(16, 185, 129, 0.1) 0%, transparent 50%),
                        radial-gradient(ellipse at bottom, rgba(14, 165, 233, 0.1) 0%, transparent 50%);
            animation: aurora 20s linear infinite;
        }
        
        @keyframes aurora {
            0%, 100% { opacity: 0.3; transform: translateY(0px) rotate(0deg); }
            33% { opacity: 0.6; transform: translateY(-20px) rotate(2deg); }
            66% { opacity: 0.4; transform: translateY(10px) rotate(-2deg); }
        }
        
        @keyframes ripple {
            to {
                transform: scale(20);
                opacity: 0;
            }
        }
        @keyframes slideInDown {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
        
        /* Estilos para el paginado */
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .tab-button {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .tab-button::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, #10b981, #0ea5e9);
            transition: width 0.3s ease;
        }
        
        .tab-button.active {
            color: #10b981;
        }
        
        .tab-button.active::after {
            width: 100%;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center gradient-bg p-4 relative overflow-hidden">
    <!-- Aurora Background Effect -->
    <div class="aurora"></div>
    
    <!-- Floating Geometric Shapes -->
    <div class="floating-shapes">
        <div class="shape w-32 h-32 bg-gradient-to-br from-accent-500 to-accent-600 rounded-3xl transform rotate-45"></div>
        <div class="shape w-24 h-24 bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-full"></div>
        <div class="shape w-20 h-20 bg-gradient-to-br from-accent-400 to-accent-500 rounded-2xl transform rotate-12"></div>
        <div class="shape w-16 h-16 bg-gradient-to-br from-secondary-400 to-secondary-500 rounded-full"></div>
    </div>
    
    <!-- Animated Particles -->
    <div class="particle w-2 h-2 top-1/4 left-1/3" style="animation-delay: 0s;"></div>
    <div class="particle w-1 h-1 top-1/3 right-1/4" style="animation-delay: 3s;"></div>
    <div class="particle w-3 h-3 bottom-1/4 left-1/4" style="animation-delay: 6s;"></div>
    <div class="particle w-2 h-2 bottom-1/3 right-1/3" style="animation-delay: 9s;"></div>
    
    <div class="w-full max-w-md glass-morphism rounded-3xl shadow-2xl overflow-hidden border border-opacity-20 border-white relative z-10 animate-float">
        <!-- Glowing Border Effect -->
        <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-accent-500 via-secondary-500 to-accent-500 p-0.5 animate-glow">
            <div class="w-full h-full bg-slate-900 bg-opacity-90 rounded-3xl"></div>
        </div>
        
        <div class="relative z-10">
            <!-- Header -->
            <div class="bg-gradient-to-br from-accent-600 via-accent-700 to-secondary-600 text-white p-8 text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-10 transform -skew-x-12 animate-pulse"></div>
                <div class="w-20 h-20 bg-gradient-to-br from-white to-accent-100 bg-opacity-20 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg relative z-10 animate-float">
                    <i class="fas fa-box-open text-white text-3xl drop-shadow-lg"></i>
                </div>
                <h2 class="text-3xl font-bold mb-2 text-shadow relative z-10">BoxWare</h2>
                <p class="text-accent-100 font-medium relative z-10">Sistema de Gestión de Inventarios</p>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-accent-400 to-transparent rounded-full opacity-20 transform translate-x-16 -translate-y-16"></div>
            </div>
            
            <!-- Body -->
            <div class="p-8 bg-gradient-to-br from-slate-800 via-slate-900 to-slate-800">
                <!-- Error Message -->
                @if(session('error'))
                <div class="mb-6 p-4 bg-gradient-to-r from-red-900 to-red-800 bg-opacity-30 border border-red-500 border-opacity-50 rounded-xl backdrop-blur-sm" id="errorMessage">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-400 mr-3 text-lg"></i>
                        <span class="text-red-300">{{ session('error') }}</span>
                    </div>
                </div>
                @endif
                
                <!-- Success Message -->
                @if(session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-green-900 to-green-800 bg-opacity-30 border border-green-500 border-opacity-50 rounded-xl backdrop-blur-sm" id="successMessage">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-400 mr-3 text-lg"></i>
                        <span class="text-green-300">{{ session('success') }}</span>
                    </div>
                </div>
                @endif
                
                <!-- Tab Navigation -->
                <div class="flex justify-center mb-8 border-b border-slate-700 pb-4">
                    <button id="loginTabBtn" class="tab-button text-lg font-semibold mx-4 text-slate-300 hover:text-accent-400 transition-colors duration-300 active-tab">
                        <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                    </button>
                    <button id="registerTabBtn" class="tab-button text-lg font-semibold mx-4 text-slate-300 hover:text-accent-400 transition-colors duration-300">
                        <i class="fas fa-user-plus mr-2"></i>Registrarse
                    </button>
                </div>
                
                <div class="tab-content" id="loginTab">
                    <form id="loginForm" method="POST" action="{{ route('login.web') }}">
                        @csrf
                        <!-- Email Field -->
                        <div class="mb-7">
                            <label for="email" class="block text-sm font-semibold text-slate-300 mb-3">
                                <i class="fas fa-envelope mr-2 text-accent-400"></i>Correo Electrónico
                            </label>
                            <div class="relative group">
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', 'admin@admin.com') }}"
                                       class="w-full px-5 py-4 bg-slate-800 bg-opacity-50 border border-slate-600 text-white rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all duration-300 placeholder-slate-400 input-glow backdrop-blur-sm"
                                       placeholder="nombre@ejemplo.com" 
                                       required>
                                <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-accent-500 to-secondary-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                            </div>
                            @error('email')
                            <p class="mt-2 text-sm text-red-400 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        
                        <!-- Password Field -->
                        <div class="mb-8">
                            <label for="password" class="block text-sm font-semibold text-slate-300 mb-3">
                                <i class="fas fa-lock mr-2 text-accent-400"></i>Contraseña
                            </label>
                            <div class="relative group">
                                <input type="password" 
                                       id="password" 
                                       name="password"
                                       class="w-full px-5 py-4 pr-14 bg-slate-800 bg-opacity-50 border border-slate-600 text-white rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all duration-300 placeholder-slate-400 input-glow backdrop-blur-sm"
                                       placeholder="Contraseña" 
                                       required>
                                <button type="button" 
                                        onclick="togglePassword()"
                                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-accent-400 transition-colors duration-300">
                                    <i class="fas fa-eye text-lg" id="passwordIcon"></i>
                                </button>
                                <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-accent-500 to-secondary-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                            </div>
                            @error('password')
                            <p class="mt-2 text-sm text-red-400 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" 
                                id="loginBtn"
                                class="w-full bg-gradient-to-r from-accent-600 via-accent-500 to-secondary-600 text-white font-bold py-4 px-6 rounded-xl hover:from-accent-700 hover:via-accent-600 hover:to-secondary-700 focus:outline-none focus:ring-4 focus:ring-accent-500 focus:ring-opacity-50 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-2xl btn-hover relative overflow-hidden">
                            <i class="fas fa-sign-in-alt mr-3 text-lg"></i>
                            <span id="loginText">Iniciar Sesión</span>
                            <span id="loadingText" class="hidden">
                                <i class="fas fa-spinner fa-spin mr-3"></i>Iniciando...
                            </span>
                        </button>
                    </form>
                </div>
                
                <div class="tab-content" id="registerTab">
                    <form id="registerForm" method="POST" action="{{ route('register.web') }}">
                        @csrf
                        <!-- Contenedor con scroll para el formulario -->
                        <div class="max-h-[60vh] overflow-y-auto pr-2 pb-2 custom-scrollbar">
                            <!-- Nombre y Apellido en la misma fila -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                                <!-- Nombre Field -->
                                <div>
                                    <label for="nombre" class="block text-sm font-semibold text-slate-300 mb-1">
                                        <i class="fas fa-user mr-2 text-accent-400"></i>Nombre
                                    </label>
                                    <div class="relative group">
                                        <input type="text" 
                                               id="nombre" 
                                               name="nombre" 
                                               value="{{ old('nombre') }}"
                                               class="w-full px-3 py-2 bg-slate-800 bg-opacity-50 border border-slate-600 text-white rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all duration-300 placeholder-slate-400 input-glow backdrop-blur-sm"
                                               placeholder="Tu nombre" 
                                               required>
                                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-accent-500 to-secondary-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                                    </div>
                                    @error('nombre')
                                    <p class="mt-1 text-xs text-red-400 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                
                                <!-- Apellido Field -->
                                <div>
                                    <label for="apellido" class="block text-sm font-semibold text-slate-300 mb-1">
                                        <i class="fas fa-user mr-2 text-accent-400"></i>Apellido
                                    </label>
                                    <div class="relative group">
                                        <input type="text" 
                                               id="apellido" 
                                               name="apellido" 
                                               value="{{ old('apellido') }}"
                                               class="w-full px-3 py-2 bg-slate-800 bg-opacity-50 border border-slate-600 text-white rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all duration-300 placeholder-slate-400 input-glow backdrop-blur-sm"
                                               placeholder="Tu apellido" 
                                               required>
                                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-accent-500 to-secondary-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                                    </div>
                                    @error('apellido')
                                    <p class="mt-1 text-xs text-red-400 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Cédula y Edad en la misma fila -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                                <!-- Cédula Field -->
                                <div>
                                    <label for="cedula" class="block text-sm font-semibold text-slate-300 mb-1">
                                        <i class="fas fa-id-card mr-2 text-accent-400"></i>Cédula
                                    </label>
                                    <div class="relative group">
                                        <input type="text" 
                                               id="cedula" 
                                               name="cedula" 
                                               value="{{ old('cedula') }}"
                                               class="w-full px-3 py-2 bg-slate-800 bg-opacity-50 border border-slate-600 text-white rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all duration-300 placeholder-slate-400 input-glow backdrop-blur-sm"
                                               placeholder="Número de identificación" 
                                               required>
                                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-accent-500 to-secondary-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                                    </div>
                                    @error('cedula')
                                    <p class="mt-1 text-xs text-red-400 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                
                                <!-- Edad Field -->
                                <div>
                                    <label for="edad" class="block text-sm font-semibold text-slate-300 mb-1">
                                        <i class="fas fa-birthday-cake mr-2 text-accent-400"></i>Edad
                                    </label>
                                    <div class="relative group">
                                        <input type="number" 
                                               id="edad" 
                                               name="edad" 
                                               value="{{ old('edad') }}"
                                               class="w-full px-3 py-2 bg-slate-800 bg-opacity-50 border border-slate-600 text-white rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all duration-300 placeholder-slate-400 input-glow backdrop-blur-sm"
                                               placeholder="Tu edad" 
                                               min="18"
                                               required>
                                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-accent-500 to-secondary-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                                    </div>
                                    @error('edad')
                                    <p class="mt-1 text-xs text-red-400 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Email y Teléfono en la misma fila -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                                <!-- Email Field -->
                                <div>
                                    <label for="register_email" class="block text-sm font-semibold text-slate-300 mb-1">
                                        <i class="fas fa-envelope mr-2 text-accent-400"></i>Correo
                                    </label>
                                    <div class="relative group">
                                        <input type="email" 
                                               id="register_email" 
                                               name="email" 
                                               value="{{ old('email') }}"
                                               class="w-full px-3 py-2 bg-slate-800 bg-opacity-50 border border-slate-600 text-white rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all duration-300 placeholder-slate-400 input-glow backdrop-blur-sm"
                                               placeholder="nombre@ejemplo.com" 
                                               required>
                                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-accent-500 to-secondary-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                                    </div>
                                    @error('email')
                                    <p class="mt-1 text-xs text-red-400 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                
                                <!-- Teléfono Field -->
                                <div>
                                    <label for="telefono" class="block text-sm font-semibold text-slate-300 mb-1">
                                        <i class="fas fa-phone mr-2 text-accent-400"></i>Teléfono
                                    </label>
                                    <div class="relative group">
                                        <input type="text" 
                                               id="telefono" 
                                               name="telefono" 
                                               value="{{ old('telefono') }}"
                                               class="w-full px-3 py-2 bg-slate-800 bg-opacity-50 border border-slate-600 text-white rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all duration-300 placeholder-slate-400 input-glow backdrop-blur-sm"
                                               placeholder="Tu número de teléfono" 
                                               required>
                                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-accent-500 to-secondary-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                                    </div>
                                    @error('telefono')
                                    <p class="mt-1 text-xs text-red-400 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Password y Confirm Password en la misma fila -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                                <!-- Password Field -->
                                <div>
                                    <label for="register_password" class="block text-sm font-semibold text-slate-300 mb-1">
                                        <i class="fas fa-lock mr-2 text-accent-400"></i>Contraseña
                                    </label>
                                    <div class="relative group">
                                        <input type="password" 
                                               id="register_password" 
                                               name="password"
                                               class="w-full px-3 py-2 pr-10 bg-slate-800 bg-opacity-50 border border-slate-600 text-white rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all duration-300 placeholder-slate-400 input-glow backdrop-blur-sm"
                                               placeholder="Mínimo 8 caracteres" 
                                               required>
                                        <button type="button" 
                                                onclick="toggleRegisterPassword()"
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-accent-400 transition-colors duration-300">
                                            <i class="fas fa-eye text-sm" id="registerPasswordIcon"></i>
                                        </button>
                                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-accent-500 to-secondary-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                                    </div>
                                    @error('password')
                                    <p class="mt-1 text-xs text-red-400 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                
                                <!-- Confirm Password Field -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-300 mb-1">
                                        <i class="fas fa-lock mr-2 text-accent-400"></i>Confirmar
                                    </label>
                                    <div class="relative group">
                                        <input type="password" 
                                               id="password_confirmation" 
                                               name="password_confirmation"
                                               class="w-full px-3 py-2 bg-slate-800 bg-opacity-50 border border-slate-600 text-white rounded-xl focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all duration-300 placeholder-slate-400 input-glow backdrop-blur-sm"
                                               placeholder="Confirmar contraseña" 
                                               required>
                                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-accent-500 to-secondary-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                                    </div>
                                    @error('password_confirmation')
                                    <p class="mt-1 text-xs text-red-400 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" 
                                id="registerBtn"
                                class="w-full mt-4 bg-gradient-to-r from-accent-600 via-accent-500 to-secondary-600 text-white font-bold py-3 px-6 rounded-xl hover:from-accent-700 hover:via-accent-600 hover:to-secondary-700 focus:outline-none focus:ring-4 focus:ring-accent-500 focus:ring-opacity-50 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-2xl btn-hover relative overflow-hidden">
                            <i class="fas fa-user-plus mr-3 text-lg"></i>
                            <span id="registerText">Registrarse</span>
                            <span id="registerLoadingText" class="hidden">
                                <i class="fas fa-spinner fa-spin mr-3"></i>Registrando...
                            </span>
                        </button>
                    </form>
                </div>
                
                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-slate-400">
                        ¿Ya tienes cuenta? 
                        <a href="#" class="text-accent-400 hover:text-accent-300 font-semibold transition-colors duration-300 hover:underline">Iniciar Sesión</a>
                    </p>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute bottom-4 right-4 w-16 h-16 bg-gradient-to-br from-accent-500 to-secondary-500 rounded-full opacity-10 animate-pulse"></div>
                <div class="absolute top-4 left-4 w-8 h-8 bg-gradient-to-br from-secondary-400 to-accent-400 rounded-full opacity-20 animate-bounce"></div>
            </div>
        </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
        
        function toggleRegisterPassword() {
            const passwordInput = document.getElementById('register_password');
            const passwordIcon = document.getElementById('registerPasswordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
        
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginBtn = document.getElementById('loginBtn');
            const loginText = document.getElementById('loginText');
            const loadingText = document.getElementById('loadingText');
            
            loginBtn.disabled = true;
            loginBtn.classList.add('opacity-75', 'cursor-not-allowed');
            loginText.classList.add('hidden');
            loadingText.classList.remove('hidden');
        });
        
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const registerBtn = document.getElementById('registerBtn');
            const registerText = document.getElementById('registerText');
            const registerLoadingText = document.getElementById('registerLoadingText');
            
            registerBtn.disabled = true;
            registerBtn.classList.add('opacity-75', 'cursor-not-allowed');
            registerText.classList.add('hidden');
            registerLoadingText.classList.remove('hidden');
        });
        
        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const loginTabBtn = document.getElementById('loginTabBtn');
            const registerTabBtn = document.getElementById('registerTabBtn');
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');
            
            // Initialize tabs
            showTab('login');
            
            loginTabBtn.addEventListener('click', function(e) {
                e.preventDefault();
                showTab('login');
            });
            
            registerTabBtn.addEventListener('click', function(e) {
                e.preventDefault();
                showTab('register');
            });
            
            // Footer link to switch tabs
            const footerLink = document.querySelector('.text-accent-400');
            if (footerLink) {
                footerLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (loginTab.classList.contains('active')) {
                        showTab('register');
                    } else {
                        showTab('login');
                    }
                });
            }
        });
        
        // Add some interactive particles on click
        document.addEventListener('click', function(e) {
            createRipple(e.clientX, e.clientY);
        });
        
        function createRipple(x, y) {
            const ripple = document.createElement('div');
            ripple.className = 'absolute w-3 h-3 bg-accent-400 rounded-full pointer-events-none';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            document.body.appendChild(ripple);
            
            ripple.animate([
                { transform: 'scale(1)', opacity: 0.8 },
                { transform: 'scale(15)', opacity: 0 }
            ], {
                duration: 1000,
                easing: 'cubic-bezier(0.22, 1, 0.36, 1)'
            }).onfinish = function() {
                ripple.remove();
            };
        }
        
        function showTab(tab) {
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');
            const loginButton = document.getElementById('loginTabBtn');
            const registerButton = document.getElementById('registerTabBtn');
            
            if (tab === 'login') {
                loginTab.classList.add('active');
                registerTab.classList.remove('active');
                loginButton.classList.add('active-tab');
                registerButton.classList.remove('active-tab');
            } else if (tab === 'register') {
                loginTab.classList.remove('active');
                registerTab.classList.add('active');
                loginButton.classList.remove('active-tab');
                registerButton.classList.add('active-tab');
            }
        }
    </script>
</body>
</html>