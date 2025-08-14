<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run()
    {
        // Use create instead of updateOrInsert to ensure all fields are properly set
        Rol::firstOrCreate(
            ['nombre_rol' => env('SEED_ROLE_ADMIN', 'Super Administrador')],
            [
                'descripcion' => 'El super usuario',
                'estado' => true,
                'fecha_creacion' => now(),
                'fecha_modificacion' => now(),
            ]
        );
    }
}
