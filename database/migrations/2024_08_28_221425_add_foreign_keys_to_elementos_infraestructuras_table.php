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
        Schema::table('elementos_infraestructuras', function (Blueprint $table) {
            $table->foreign(['fk_espacio'], 'fk_elementos_infraestructuras_areas1')->references(['id_espacio'])->on('espacios')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_tipoElement'], 'fk_elementos_infraestructuras_tipos_elementos1')->references(['id_tipoElement'])->on('tipos_elementos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('elementos_infraestructuras', function (Blueprint $table) {
            $table->dropForeign('fk_elementos_infraestructuras_areas1');
            $table->dropForeign('fk_elementos_infraestructuras_tipos_elementos1');
        });
    }
};
