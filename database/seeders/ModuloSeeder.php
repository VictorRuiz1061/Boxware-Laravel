<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModuloSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/modulos.json'));
        $modulos = json_decode($json, true)['data']['data'];

        foreach ($modulos as $modulo) {
            // Convertir las fechas de ISO a formato MySQL
            $fechaAccion = Carbon::parse($modulo['fecha_accion'])->format('Y-m-d H:i:s');
            $fechaCreacion = Carbon::parse($modulo['fecha_creacion'])->format('Y-m-d H:i:s');

            DB::table('modulos')->updateOrInsert(
                ['id_modulo' => $modulo['id_modulo']],
                [
                    'fecha_accion' => $fechaAccion,
                    'rutas' => $modulo['rutas'],
                    'descripcion_ruta' => $modulo['descripcion_ruta'],
                    'mensaje_cambio' => $modulo['mensaje_cambio'],
                    'imagen' => $modulo['imagen'],
                    'estado' => $modulo['estado'],
                    'fecha_creacion' => $fechaCreacion,
                    'es_submenu' => $modulo['es_submenu'],
                    'modulo_padre_id' => $modulo['modulo_padre_id'],
                ]
            );
        }
    }
}
