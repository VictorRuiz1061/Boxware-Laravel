<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>BoxWare - Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#667eea',
                            600: '#5a67d8',
                            700: '#4c51bf',
                            900: '#764ba2',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-500 to-primary-900 p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-500 to-primary-900 text-white p-8 text-center">
            <h2 class="text-2xl font-semibold mb-2">
                <i class="fas fa-box-open mr-2"></i>BoxWare
            </h2>
            <p class="text-primary-50">Sistema de Gestión de Inventarios</p>
        </div>
        
        <!-- Body -->
        <div class="p-8">
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                        <span class="text-red-700">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span class="text-green-700">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            
            <form id="loginForm" method="POST" action="{{ route('login.web') }}">
                @csrf
                
                <!-- Email Field -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Correo Electrónico
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', 'admin@admin.com') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('email') @enderror"
                           placeholder="nombre@ejemplo.com" 
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Field -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Contraseña
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password"
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('password') @enderror"
                               placeholder="Contraseña" 
                               required>
                        <button type="button" 
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-primary-500 transition-colors">
                            <i class="fas fa-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Remember Me -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               id="remember" 
                               name="remember"
                               class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Recordarme</span>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" 
                        id="loginBtn"
                        class="w-full bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transform hover:-translate-y-0.5 transition-all duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    <span id="loginText">Iniciar Sesión</span>
                    <span id="loadingText" class="hidden">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Iniciando...
                    </span>
                </button>
            </form>
            
            <!-- Footer -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    ¿No tienes cuenta? 
                    <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Contacta al administrador</a>
                </p>
                <!-- Credenciales de desarrollo -->
                <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-500">
                        <strong>Desarrollo:</strong> admin@admin.com / admin
                    </p>
=======
    <title>Login | BoxWare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0f172a;
            overflow: hidden;
        }
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
        }
        .form-container {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .glass-effect {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(71, 85, 105, 0.3);
        }
    </style>
</head>
<body>
    <div id="particles-js"></div>
    <div class="form-container">
        <div class="w-full max-w-md">
            <div class="glass-effect p-8 rounded-2xl shadow-2xl" x-data="{ activeTab: 'login' }">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white">Bienvenido a BoxWare</h1>
                </div>

                <div class="mb-8 flex justify-center border-b border-primary-700">
                    <button @click="activeTab = 'login'" :class="{ 'border-accent-500 text-white': activeTab === 'login', 'border-transparent text-primary-300 hover:text-white': activeTab !== 'login' }" class="px-6 py-3 font-semibold border-b-2 transition-all duration-200">Iniciar Sesión</button>
                    <button @click="activeTab = 'register'" :class="{ 'border-accent-500 text-white': activeTab === 'register', 'border-transparent text-primary-300 hover:text-white': activeTab !== 'register' }" class="px-6 py-3 font-semibold border-b-2 transition-all duration-200">Registrarse</button>
                </div>

                @if($errors->any())
                    <div class="bg-red-900 bg-opacity-50 text-red-300 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <div x-show="activeTab === 'login'" x-transition>
                    <form method="POST" action="{{ route('login.web') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-gray-300 font-semibold mb-2">Email</label>
                            <input type="email" name="email" placeholder="tu@email.com" class="w-full bg-gray-800 border border-gray-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ old('email') }}">
                        </div>
                        <div>
                            <label class="block text-gray-300 font-semibold mb-2">Contraseña</label>
                            <input type="password" name="password" placeholder="Tu contraseña" class="w-full bg-gray-800 border border-gray-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <a href="#" class="text-sm text-blue-500 hover:text-blue-600">¿Olvidaste tu contraseña?</a>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200">Iniciar Sesión</button>
                        </div>
                    </form>
                </div>

                <!-- Registration Form -->
                <div x-show="activeTab === 'register'" x-transition>
                    <form method="POST" action="{{ route('register.web') }}" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-300 font-semibold mb-2">Nombre</label>
                                <input type="text" name="nombre" placeholder="Tu nombre" class="w-full bg-gray-800 border border-gray-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ old('nombre') }}">
                            </div>
                            <div>
                                <label class="block text-gray-300 font-semibold mb-2">Apellido</label>
                                <input type="text" name="apellido" placeholder="Tu apellido" class="w-full bg-gray-800 border border-gray-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ old('apellido') }}">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-300 font-semibold mb-2">Cédula</label>
                                <input type="text" name="cedula" placeholder="Tu cédula" class="w-full bg-gray-800 border border-gray-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ old('cedula') }}">
                            </div>
                            <div>
                                <label class="block text-gray-300 font-semibold mb-2">Edad</label>
                                <input type="number" name="edad" placeholder="Tu edad" class="w-full bg-gray-800 border border-gray-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ old('edad') }}">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-300 font-semibold mb-2">Email</label>
                                <input type="email" name="email" placeholder="tu@email.com" class="w-full bg-gray-800 border border-gray-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ old('email') }}">
                            </div>
                            <div>
                                <label class="block text-gray-300 font-semibold mb-2">Teléfono</label>
                                <input type="text" name="telefono" placeholder="Tu teléfono" class="w-full bg-gray-800 border border-gray-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ old('telefono') }}">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-300 font-semibold mb-2">Contraseña</label>
                                <input type="password" name="password" placeholder="Tu contraseña" class="w-full bg-gray-800 border border-gray-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-gray-300 font-semibold mb-2">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" placeholder="Confirma tu contraseña" class="w-full bg-gray-800 border border-gray-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200">Registrarse</button>
                        </div>
                    </form>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
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
        
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginBtn = document.getElementById('loginBtn');
            const loginText = document.getElementById('loginText');
            const loadingText = document.getElementById('loadingText');
            
            loginBtn.disabled = true;
            loginText.classList.add('hidden');
            loadingText.classList.remove('hidden');
        });
    </script>
</body>
</html> 
=======
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                },
                "size": {
                    "value": 3,
                    "random": true,
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 6,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                }
            },
            "retina_detect": true
        });
    </script>
</body>
</html>
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
