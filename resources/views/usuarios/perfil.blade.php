@extends('layouts.app')

@section('title', 'Mi Perfil | BoxWare')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Izquierda: Tarjeta de Perfil -->
        <div class="lg:col-span-1">
            <div class="glass-effect p-8 rounded-2xl text-center">
                <div class="relative inline-block mb-6">
                    <img src="{{ $usuario->imagen ? Storage::url($usuario->imagen) : 'https://ui-avatars.com/api/?name=' . urlencode($usuario->nombre) . '&color=7F9CF5&background=EBF4FF' }}" 
                         alt="Imagen de perfil" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-accent-500 shadow-lg">
                    <span class="absolute bottom-2 right-2 bg-green-500 border-2 border-primary-800 rounded-full w-5 h-5"></span>
                </div>
                <h2 class="text-2xl font-bold text-white">{{ $usuario->nombre }} {{ $usuario->apellido }}</h2>
                <p class="text-primary-300 mt-1">{{ $usuario->rol->nombre_rol ?? 'Usuario' }}</p>
            </div>
        </div>

        <!-- Columna Derecha: Formulario de Edición con Pestañas -->
        <div class="lg:col-span-2">
            <div class="glass-effect rounded-2xl border border-primary-700 overflow-hidden">
                @if(session('success'))
                    <div class="bg-green-900 bg-opacity-50 text-green-300 border-l-4 border-green-500 p-4 m-6 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-red-900 bg-opacity-50 text-red-300 border-l-4 border-red-500 p-4 m-6 rounded-lg">
                        <p class="font-bold mb-2">Hubo algunos errores:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('usuarios.perfil.actualizar') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-white mb-6">Información Personal</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-primary-300 font-semibold mb-2">Nombre</label>
                                <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500" required>
                            </div>
                            <div>
                                <label class="block text-primary-300 font-semibold mb-2">Apellido</label>
                                <input type="text" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500" required>
                            </div>
                            <div>
                                <label class="block text-primary-300 font-semibold mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $usuario->email) }}" class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500" required>
                            </div>
                            <div>
                                <label class="block text-primary-300 font-semibold mb-2">Cédula</label>
                                <input type="text" name="cedula" value="{{ old('cedula', $usuario->cedula) }}" class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500" required>
                            </div>
                            <div>
                                <label class="block text-primary-300 font-semibold mb-2">Edad</label>
                                <input type="number" name="edad" value="{{ old('edad', $usuario->edad) }}" class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500" required>
                            </div>
                            <div>
                                <label class="block text-primary-300 font-semibold mb-2">Teléfono</label>
                                <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}" class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500" required>
                            </div>
                        </div>

                        <hr class="border-primary-700 my-8">

                        <h3 class="text-xl font-bold text-white mb-6">Seguridad y Apariencia</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <div>
                                <label class="block text-primary-300 font-semibold mb-2">Nueva Contraseña (opcional)</label>
                                <input type="password" name="password" placeholder="Dejar en blanco para no cambiar" class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500">
                            </div>
                            <div>
                                <label class="block text-primary-300 font-semibold mb-2">Imagen de Perfil</label>
                                <input type="file" name="imagen" class="w-full text-sm text-primary-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent-600 file:text-white hover:file:bg-accent-700"/>
                            </div>
                        </div>
                    </div>

                    <div class="bg-primary-800 bg-opacity-50 px-8 py-4 border-t border-primary-700 flex justify-end">
                        <button type="submit" class="bg-accent-600 hover:bg-accent-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection