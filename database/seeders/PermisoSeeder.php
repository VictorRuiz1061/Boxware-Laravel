<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\Modulo;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    public function run()
    {
        // Eliminar todos los permisos existentes
        Permiso::truncate();

        // Rol admin
        $rol = Rol::where('nombre_rol', env('SEED_ROLE_ADMIN', 'Super Administrador'))->first();
        if (!$rol) {
            $this->command->error('Rol admin no encontrado.');
            return;
        }

        // Leer módulos desde la base de datos
        $modulos = Modulo::all();
        if ($modulos->isEmpty()) {
            $this->command->error('No hay módulos en la base de datos.');
            return;
        }

        // Obtener todos los IDs de módulos
        $moduloIds = $modulos->pluck('id_modulo')->toArray();

        // Crear un solo permiso con todos los módulos
        Permiso::updateOrInsert(
            [
                'rol_id' => $rol->id_rol,
                'nombre' => 'Permiso global de módulos',
            ],
            [
                'modulo_ids' => json_encode($moduloIds),
                'estado' => true,
                'puede_ver' => true,
                'puede_crear' => true,
                'puede_editar' => true,
                'puede_eliminar' => true,
                'fecha_creacion' => now(),
            ]
        );

    }
}