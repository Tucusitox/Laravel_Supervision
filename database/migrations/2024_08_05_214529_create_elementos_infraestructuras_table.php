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
        Schema::create('elementos_infraestructuras', function (Blueprint $table) {
            $table->integer('id_elementInfra', true);
            $table->integer('fk_tipoElement')->index('fk_elementos_infraestructuras_tipos_elementos1_idx');
            $table->integer('fk_espacio')->index('fk_elementos_infraestructuras_areas1_idx');
            $table->string('descripcion_element', 500);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos_infraestructuras');
    }
};
