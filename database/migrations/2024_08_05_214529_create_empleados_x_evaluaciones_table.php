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
        Schema::create('empleados_x_evaluaciones', function (Blueprint $table) {
            $table->integer('id_empEval', true);
            $table->integer('fk_empleado')->index('fk_empleados_has_evaluaciones_empleados1_idx');
            $table->integer('fk_evaluacion')->index('fk_empleados_has_evaluaciones_evaluaciones1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados_x_evaluaciones');
    }
};
