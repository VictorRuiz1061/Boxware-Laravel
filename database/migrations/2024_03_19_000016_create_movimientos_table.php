<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id('id_movimiento');
            $table->boolean('estado');
            $table->integer('cantidad');
            $table->foreignId('material_id')->constrained('materiales', 'id_material');
            $table->foreignId('tipo_movimiento_id')->constrained('tipos_movimiento', 'id_tipo_movimiento');
            $table->foreignId('sitio_id')->constrained('sitios', 'id_sitio');
            $table->foreignId('sitio_origen_id')->constrained('sitios', 'id_sitio')->nullable();
            $table->foreignId('sitio_destino_id')->constrained('sitios', 'id_sitio')->nullable();
            $table->foreignId('usuario_movimiento_id')->constrained('usuarios', 'id_usuario');
            $table->foreignId('usuario_responsable_id')->constrained('usuarios', 'id_usuario');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_modificacion')->useCurrentOnUpdate()->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}; 