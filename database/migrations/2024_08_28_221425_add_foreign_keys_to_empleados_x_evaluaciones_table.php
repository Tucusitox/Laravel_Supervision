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
        Schema::table('empleados_x_evaluaciones', function (Blueprint $table) {
            $table->foreign(['fk_empleado'], 'fk_empleados_has_evaluaciones_empleados1')->references(['id_empleado'])->on('empleados')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_evaluacion'], 'fk_empleados_has_evaluaciones_evaluaciones1')->references(['id_evaluacion'])->on('evaluaciones')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleados_x_evaluaciones', function (Blueprint $table) {
            $table->dropForeign('fk_empleados_has_evaluaciones_empleados1');
            $table->dropForeign('fk_empleados_has_evaluaciones_evaluaciones1');
        });
    }
};
