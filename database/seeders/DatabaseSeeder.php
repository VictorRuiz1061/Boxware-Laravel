<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /* agrega un usuario administrador y un rol llamado admin */
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            UsuarioAdminSeeder::class,
            ModuloSeeder::class,
        ]);
    }
}
