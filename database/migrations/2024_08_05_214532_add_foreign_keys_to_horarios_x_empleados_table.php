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
        Schema::table('horarios_x_empleados', function (Blueprint $table) {
            $table->foreign(['fk_empleado'], 'fk_horarios_has_empleados_empleados1')->references(['id_empleado'])->on('empleados')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_horario'], 'fk_horarios_has_empleados_horarios1')->references(['id_horario'])->on('horarios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('horarios_x_empleados', function (Blueprint $table) {
            $table->dropForeign('fk_horarios_has_empleados_empleados1');
            $table->dropForeign('fk_horarios_has_empleados_horarios1');
        });
    }
};
