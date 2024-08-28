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
        Schema::create('espacios_x_evaluaciones', function (Blueprint $table) {
            $table->integer('id_espaEval', true);
            $table->integer('fk_espacio')->index('fk_areas_has_evaluaciones_areas1_idx');
            $table->integer('fk_evaluacion')->index('fk_areas_has_evaluaciones_evaluaciones1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espacios_x_evaluaciones');
    }
};
