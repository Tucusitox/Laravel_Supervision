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
        Schema::create('procesos_x_evaluaciones', function (Blueprint $table) {
            $table->integer('id_procesEval', true);
            $table->integer('fk_proceso')->index('fk_procesos_has_evaluaciones_procesos1_idx');
            $table->integer('fk_evaluacion')->index('fk_procesos_has_evaluaciones_evaluaciones1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procesos_x_evaluaciones');
    }
};
