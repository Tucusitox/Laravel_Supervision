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
        Schema::create('horarios_x_empleados', function (Blueprint $table) {
            $table->integer('id_horarioEmp', true);
            $table->integer('fk_horario')->index('fk_horarios_has_empleados_horarios1_idx');
            $table->integer('fk_empleado')->index('fk_horarios_has_empleados_empleados1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_x_empleados');
    }
};
