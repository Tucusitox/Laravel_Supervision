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
        Schema::create('elementos_x_evaluaciones', function (Blueprint $table) {
            $table->integer('id_evalElement', true);
            $table->integer('fk_elementInfra')->index('fk_evaluaciones_has_elementos_infraestructuras_elementos_in_idx');
            $table->integer('fk_evaluacion')->index('fk_evaluaciones_has_elementos_infraestructuras_evaluaciones_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos_x_evaluaciones');
    }
};
