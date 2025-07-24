# Sistema de Login - BoxWare

## Descripción
Sistema de autenticación web para la aplicación BoxWare que permite a los usuarios iniciar sesión con correo electrónico y contraseña.

## Características

### ✅ Funcionalidades Implementadas
- **Login con email y contraseña**: Formulario de inicio de sesión seguro
- **Validación de credenciales**: Verificación de email y contraseña
- **Verificación de estado**: Solo usuarios activos pueden acceder
- **Sesiones web**: Manejo de sesiones para usuarios web
- **Middleware de protección**: Rutas protegidas con autenticación
- **Dashboard responsivo**: Interfaz moderna después del login
- **Logout seguro**: Cierre de sesión con limpieza de datos
- **Mensajes de error/éxito**: Feedback visual para el usuario
- **Diseño moderno**: Interfaz con Bootstrap 5 y FontAwesome

### 🔧 Archivos Creados/Modificados

#### Controladores
- `app/Http/Controllers/WebAuthController.php` - Controlador para autenticación web

#### Middleware
- `app/Http/Middleware/WebAuth.php` - Middleware para proteger rutas web

#### Vistas
- `resources/views/login.blade.php` - Vista de login
- `resources/views/dashboard.blade.php` - Dashboard principal

#### Rutas
- `routes/web.php` - Rutas web actualizadas

#### Configuración
- `bootstrap/app.php` - Registro del middleware

#### Seeders
- `database/seeders/UsuarioTestSeeder.php` - Usuarios de prueba

#### Estilos
- `resources/css/app.css` - Estilos personalizados

## Instalación y Configuración

### 1. Ejecutar Migraciones
```bash
php artisan migrate
```

### 2. Ejecutar Seeders
```bash
php artisan db:seed
```

### 3. Compilar Assets (opcional)
```bash
npm install
npm run dev
```

## Usuarios de Prueba

Después de ejecutar los seeders, tendrás estos usuarios disponibles:

### Administrador
- **Email**: `admin@admin.com`
- **Contraseña**: `admin`

*Nota: Este usuario se crea automáticamente con el `UsuarioAdminSeeder.php`*

## Rutas Disponibles

### Rutas Públicas
- `GET /` - Redirige al login
- `GET /login` - Formulario de login
- `POST /login` - Procesar login

### Rutas Protegidas
- `GET /dashboard` - Dashboard principal (requiere autenticación)
- `POST /logout` - Cerrar sesión

## Características de Seguridad

### ✅ Implementadas
- **Hash de contraseñas**: Usando `Hash::make()`
- **Validación de entrada**: Reglas de validación en el controlador
- **Verificación de estado**: Solo usuarios activos
- **Protección CSRF**: Tokens CSRF en formularios
- **Middleware de autenticación**: Rutas protegidas
- **Limpieza de sesión**: Al cerrar sesión

### 🔒 Validaciones
- Email requerido y formato válido
- Contraseña requerida
- Usuario debe existir en la base de datos
- Usuario debe estar activo
- Contraseña debe coincidir

## Estructura de Sesión

Al iniciar sesión, se almacenan estos datos en la sesión:
```php
session([
    'usuario_id' => $usuario->id_usuario,
    'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido,
    'usuario_email' => $usuario->email,
    'usuario_rol' => $usuario->rol ? $usuario->rol->nombre_rol : 'Sin rol',
    'usuario_rol_id' => $usuario->rol_id,
]);
```

## Personalización

### Cambiar Colores
Los colores principales están definidos en `resources/css/app.css`:
```css
:root {
    --primary-color: #667eea;
    --secondary-color: #764ba2;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
}
```

### Agregar Campos al Login
Para agregar campos adicionales al formulario de login:

1. Modificar `resources/views/login.blade.php`
2. Actualizar validaciones en `WebAuthController::login()`
3. Agregar campos a la sesión si es necesario

## Troubleshooting

### Problema: "Usuario no encontrado"
- Verificar que el usuario existe en la base de datos
- Verificar que el email está escrito correctamente

### Problema: "Credenciales incorrectas"
- Verificar que la contraseña es correcta
- Verificar que el usuario está activo

### Problema: "Debes iniciar sesión"
- Verificar que la sesión no haya expirado
- Verificar que el middleware está configurado correctamente

## Próximos Pasos Sugeridos

1. **Implementar recuperación de contraseña**
2. **Agregar verificación de email**
3. **Implementar autenticación de dos factores**
4. **Agregar logs de acceso**
5. **Implementar bloqueo por intentos fallidos**
6. **Agregar perfiles de usuario**
7. **Implementar roles y permisos más granulares**

## Soporte

Para cualquier problema o duda sobre el sistema de login, revisa:
1. Los logs de Laravel en `storage/logs/`
2. La configuración de sesiones en `config/session.php`
3. La configuración de autenticación en `config/auth.php` 