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
<<<<<<< Updated upstream
            $table->timestamp('fecha_creacion');
            $table->foreignId('modulo_id')->constrained('modulos', 'id_modulo');
=======
            $table->boolean('puede_eliminar');
            $table->timestamp('fecha_creacion');
            $table->json('modulo_ids')->nullable();
>>>>>>> Stashed changes
            $table->foreignId('rol_id')->constrained('roles', 'id_rol');
        });
    }

    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}; 