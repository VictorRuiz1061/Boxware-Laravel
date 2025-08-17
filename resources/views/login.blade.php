<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                </div>
            </div>
        </div>
    </div>

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