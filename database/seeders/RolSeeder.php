<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run()
    {
<<<<<<< HEAD
        Rol::updateOrInsert(
=======
        // Use create instead of updateOrInsert to ensure all fields are properly set
        Rol::firstOrCreate(
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
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
