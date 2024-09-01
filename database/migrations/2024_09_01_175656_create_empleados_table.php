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
        Schema::create('empleados', function (Blueprint $table) {
            $table->integer('id_empleado', true);
            $table->integer('fk_persona')->index('fk_empleados_personas1_idx');
            $table->integer('fk_tipo_emp')->index('fk_empleados_tipos_emp1_idx');
            $table->integer('fk_cargo')->index('fk_empleados_cargos1_idx');
            $table->string('estado_laboral', 100);
            $table->date('fecha_ingreso');
            $table->date('fecha_egreso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
