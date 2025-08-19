@extends('layouts.app')

<<<<<<< HEAD
@section('title', 'Crear movimiento | BoxWare')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Crear movimiento</h2>
    <form method="POST" action="{{ route('movimientos.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Cantidad</label>
            <input type="number" name="cantidad" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Fecha creación</label>
            <input type="text" name="fecha_creacion" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Fecha modificación</label>
            <input type="text" name="fecha_modificacion" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Usuario</label>
            <select name="usuario_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Selecciona un usuario</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}" {{ old('usuario_id') == $usuario->id_usuario ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Material</label>
            <select name="material_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Selecciona un material</option>
                @foreach($materiales as $material)
                    <option value="{{ $material->id_material }}" {{ old('material_id') == $material->id_material ? 'selected' : '' }}>{{ $material->nombre_material }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Tipo de movimiento</label>
            <select name="tipo_movimiento_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Selecciona un tipo de movimiento</option>
                @foreach($tipo_movimientos as $tipo_movimiento)
                    <option value="{{ $tipo_movimiento->id_tipo_movimiento }}" {{ old('tipo_movimiento_id') == $tipo_movimiento->id_tipo_movimiento ? 'selected' : '' }}>{{ $tipo_movimiento->nombre_tipo_movimiento }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Sitio</label>
            <select name="sitio_id" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">Selecciona un sitio</option>
                @foreach($sitios as $sitio)
                    <option value="{{ $sitio->id_sitio }}" {{ old('sitio_id') == $sitio->id_sitio ? 'selected' : '' }}>{{ $sitio->nombre_sitio }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('movimientos.index') }}" class="mr-4 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700">Guardar</button>
        </div>
    </form>
</div>
@endsection 
=======
@section('title', 'Registrar Movimiento | BoxWare')

@section('content')
<!-- Header Section -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Registrar Movimiento</h1>
        <p class="text-primary-300">Registra un nuevo movimiento en el inventario del sistema BoxWare</p>
    </div>
    <a href="{{ route('movimientos.index') }}" 
       class="flex items-center space-x-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200">
        <i class="fas fa-arrow-left text-sm"></i>
        <span>Volver</span>
    </a>
</div>

<div class="max-w-4xl mx-auto">
    <div class="glass-effect rounded-xl border border-primary-700 overflow-hidden">
        <!-- Form Header -->
        <div class="bg-primary-800 bg-opacity-50 px-8 py-6 border-b border-primary-700">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exchange-alt text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Información del Movimiento</h3>
                    <p class="text-primary-300 text-sm">Completa todos los campos requeridos</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form method="POST" action="{{ route('movimientos.store') }}" class="space-y-8" id="movimientoForm">
                @csrf
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

                <!-- Tipo de Movimiento Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-tag text-white text-sm"></i>
                        </div>
                        Tipo de Movimiento
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-exchange-alt mr-2 text-accent-500"></i>
                                    Tipo de Movimiento
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="tipo_movimiento_id" id="tipo_movimiento_id"
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                <option value="" class="bg-primary-800">Selecciona un tipo de movimiento</option>
                                @foreach($tipo_movimientos as $tipo)
                                    <option value="{{ $tipo->id_tipo_movimiento }}" class="bg-primary-800" {{ old('tipo_movimiento_id') == $tipo->id_tipo_movimiento ? 'selected' : '' }}>
                                        {{ $tipo->tipo_movimiento }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_movimiento_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-toggle-on mr-2 text-accent-500"></i>
                                    Estado
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="estado" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                <option value="1" class="bg-primary-800" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" class="bg-primary-800" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Material y Cantidad Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-boxes text-white text-sm"></i>
                        </div>
                        Material y Cantidad
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-box mr-2 text-accent-500"></i>
                                    Material
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="material_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                <option value="" class="bg-primary-800">Selecciona un material</option>
                                @foreach($materiales as $material)
                                    <option value="{{ $material->id_material }}" class="bg-primary-800" {{ old('material_id') == $material->id_material ? 'selected' : '' }}>
                                        {{ $material->nombre_material }}
                                    </option>
                                @endforeach
                            </select>
                            @error('material_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-sort-amount-up mr-2 text-accent-500"></i>
                                    Cantidad
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <input type="number" name="cantidad" min="1" 
                                   class="w-full bg-primary-800 border border-primary-600 text-white placeholder-primary-400 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200"
                                   placeholder="Ingresa la cantidad"
                                   value="{{ old('cantidad') }}" required>
                            @error('cantidad')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Ubicación Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-map-marker-alt text-white text-sm"></i>
                        </div>
                        Ubicación
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Sitio normal (para movimientos regulares) -->
                        <div id="sitio-container" class="col-span-3">
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-warehouse mr-2 text-accent-500"></i>
                                    Sitio
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="sitio_id" id="sitio_id"
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                                <option value="" class="bg-primary-800">Selecciona un sitio</option>
                                @foreach($sitios as $sitio)
                                    <option value="{{ $sitio->id_sitio }}" class="bg-primary-800" {{ old('sitio_id') == $sitio->id_sitio ? 'selected' : '' }}>
                                        {{ $sitio->nombre_sitio }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sitio_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Sitio Origen (para préstamos, traslados, etc.) -->
                        <div id="sitio-origen-container" class="md:col-span-3 lg:col-span-1 hidden">
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-sign-out-alt mr-2 text-accent-500"></i>
                                    Sitio Origen
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="sitio_origen_id" id="sitio_origen_id"
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                                <option value="" class="bg-primary-800">Selecciona un sitio de origen</option>
                                @foreach($sitios as $sitio)
                                    <option value="{{ $sitio->id_sitio }}" class="bg-primary-800" {{ old('sitio_origen_id') == $sitio->id_sitio ? 'selected' : '' }}>
                                        {{ $sitio->nombre_sitio }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sitio_origen_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Sitio Destino (para préstamos, traslados, etc.) -->
                        <div id="sitio-destino-container" class="md:col-span-3 lg:col-span-1 hidden">
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-sign-in-alt mr-2 text-accent-500"></i>
                                    Sitio Destino
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="sitio_destino_id" id="sitio_destino_id"
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200">
                                <option value="" class="bg-primary-800">Selecciona un sitio de destino</option>
                                @foreach($sitios as $sitio)
                                    <option value="{{ $sitio->id_sitio }}" class="bg-primary-800" {{ old('sitio_destino_id') == $sitio->id_sitio ? 'selected' : '' }}>
                                        {{ $sitio->nombre_sitio }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sitio_destino_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Usuarios Section -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-white text-sm"></i>
                        </div>
                        Usuarios
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-user-edit mr-2 text-accent-500"></i>
                                    Usuario que realiza el movimiento
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="usuario_movimiento_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                <option value="" class="bg-primary-800">Selecciona un usuario</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id_usuario }}" class="bg-primary-800" {{ old('usuario_movimiento_id') == $usuario->id_usuario ? 'selected' : '' }}>
                                        {{ $usuario->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('usuario_movimiento_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-primary-200 font-semibold mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-user-shield mr-2 text-accent-500"></i>
                                    Usuario responsable
                                    <span class="text-red-400 ml-1">*</span>
                                </span>
                            </label>
                            <select name="usuario_responsable_id" 
                                    class="w-full bg-primary-800 border border-primary-600 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-colors duration-200" required>
                                <option value="" class="bg-primary-800">Selecciona un usuario responsable</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id_usuario }}" class="bg-primary-800" {{ old('usuario_responsable_id') == $usuario->id_usuario ? 'selected' : '' }}>
                                        {{ $usuario->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('usuario_responsable_id')
                                <p class="mt-2 text-red-400 text-sm flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="border-t border-primary-700 pt-6 flex justify-end">
                    <a href="{{ route('movimientos.index') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center mr-4">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" id="submitBtn" class="bg-accent-600 hover:bg-accent-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Registrar Movimiento
                    </button>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('movimientoForm');
                    const submitBtn = document.getElementById('submitBtn');
                    const tipoMovimientoSelect = document.getElementById('tipo_movimiento_id');
                    const sitioContainer = document.getElementById('sitio-container');
                    const sitioOrigenContainer = document.getElementById('sitio-origen-container');
                    const sitioDestinoContainer = document.getElementById('sitio-destino-container');
                    const sitioIdSelect = document.getElementById('sitio_id');
                    const sitioOrigenIdSelect = document.getElementById('sitio_origen_id');
                    const sitioDestinoIdSelect = document.getElementById('sitio_destino_id');
                    
                    // Función para actualizar la visibilidad de los campos de ubicación
                    function updateLocationFields() {
                        const tipoMovimientoOption = tipoMovimientoSelect.options[tipoMovimientoSelect.selectedIndex];
                        const tipoMovimientoText = tipoMovimientoOption.textContent.trim().toLowerCase();
                        
                        // Mostrar/ocultar campos según el tipo de movimiento
                        if (tipoMovimientoText === 'prestamo' || tipoMovimientoText === 'préstamo' || 
                            tipoMovimientoText === 'traslado' || tipoMovimientoText === 'devolucion' || 
                            tipoMovimientoText === 'devolución') {
                            // Para préstamos, traslados y devoluciones mostrar origen y destino
                            sitioContainer.classList.add('hidden');
                            sitioOrigenContainer.classList.remove('hidden');
                            sitioDestinoContainer.classList.remove('hidden');
                            
                            // Hacer que los campos de origen y destino sean requeridos
                            sitioIdSelect.removeAttribute('required');
                            sitioOrigenIdSelect.setAttribute('required', 'required');
                            sitioDestinoIdSelect.setAttribute('required', 'required');
                        } else {
                            // Para otros tipos de movimiento mostrar solo sitio
                            sitioContainer.classList.remove('hidden');
                            sitioOrigenContainer.classList.add('hidden');
                            sitioDestinoContainer.classList.add('hidden');
                            
                            // Hacer que solo el campo de sitio sea requerido
                            sitioIdSelect.setAttribute('required', 'required');
                            sitioOrigenIdSelect.removeAttribute('required');
                            sitioDestinoIdSelect.removeAttribute('required');
                        }
                    }
                    
                    // Actualizar campos al cargar la página
                    updateLocationFields();
                    
                    // Actualizar campos cuando cambie el tipo de movimiento
                    tipoMovimientoSelect.addEventListener('change', updateLocationFields);
                    
                    form.addEventListener('submit', function(e) {
                        // Prevent default form submission
                        e.preventDefault();
                        
                        // Show loading state
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Procesando...';
                        
                        // Submit the form
                        setTimeout(function() {
                            form.submit();
                        }, 100);
                    });
                });
                </script>
            </form>
        </div>
    </div>
</div>
@endsection
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
