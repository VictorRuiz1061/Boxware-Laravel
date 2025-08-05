<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->id('id_programa');
            $table->string('nombre_programa', 255);
            $table->boolean('estado');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_modificacion')->useCurrentOnUpdate()->nullable();
            $table->foreignId('area_id')->constrained('areas', 'id_area');
        });
    }

    public function down()
    {
        Schema::dropIfExists('programas');
    }
}; 