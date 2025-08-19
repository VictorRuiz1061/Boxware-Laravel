<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;

class UsuarioAdminSeeder extends Seeder
{
    public function run()
    {
        $rol = Rol::where('nombre_rol', env('SEED_ROLE_ADMIN', 'Super Administrador'))->first();

        Usuario::updateOrInsert(
<<<<<<< HEAD
            ['email' => env('ADMIN_EMAIL')],
=======
<<<<<<< HEAD
            ['email' => env('ADMIN_EMAIL')],
=======
            ['email' => 'admin@admin.com'],
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
>>>>>>> master
            [
                'nombre' => 'admin',
                'apellido' => 'Admin',
                'edad' => 25,
                'cedula' => '000000000',
<<<<<<< HEAD
                'password' => Hash::make(env('ADMIN_PASSWORD')),
=======
<<<<<<< HEAD
                'password' => Hash::make(env('ADMIN_PASSWORD')),
=======
                'password' => Hash::make('admin'),
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
>>>>>>> master
                'telefono' => '00000000',
                'rol_id' => $rol->id_rol ?? 1,
                'estado' => true,
                'fecha_registro' => now(),
                'imagen' => 'assets/img/default.png',
            ]
        );
    }
}
