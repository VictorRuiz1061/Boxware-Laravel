<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->foreignId('sitio_origen_id')->nullable()->constrained('sitios', 'id_sitio')->after('sitio_id');
            $table->foreignId('sitio_destino_id')->nullable()->constrained('sitios', 'id_sitio')->after('sitio_origen_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropForeign(['sitio_origen_id']);
            $table->dropColumn('sitio_origen_id');
            $table->dropForeign(['sitio_destino_id']);
            $table->dropColumn('sitio_destino_id');
        });
    }
};
