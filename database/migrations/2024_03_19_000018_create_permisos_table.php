<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id('id_permiso');
            $table->string('nombre', 255);
            $table->boolean('estado');
            $table->boolean('puede_ver');
            $table->boolean('puede_crear');
            $table->boolean('puede_editar');
            $table->boolean('puede_eliminar');
            $table->timestamp('fecha_creacion');
<<<<<<< HEAD
=======
            $table->foreignId('modulo_id')->constrained('modulos', 'id_modulo');
>>>>>>> 88655fc520245c5789f48bb55f029ecb94929977
            $table->json('modulo_ids')->nullable();
            $table->foreignId('rol_id')->constrained('roles', 'id_rol');
        });
    }

    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}; 