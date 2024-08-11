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
        Schema::create('empleados_x_eventualidades', function (Blueprint $table) {
            $table->integer('id_empleadoEvent', true);
            $table->integer('fk_empleado')->index('fk_empleados_has_eventalidades_empleados1_idx');
            $table->integer('fk_eventualidad')->index('fk_empleados_has_eventalidades_eventalidades1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados_x_eventualidades');
    }
};
