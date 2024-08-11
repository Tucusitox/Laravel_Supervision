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
        Schema::create('espacios_x_procesos', function (Blueprint $table) {
            $table->integer('id_espaProces', true);
            $table->integer('fk_espacio')->index('fk_areas_has_procesos_areas1_idx');
            $table->integer('fk_proceso')->index('fk_areas_has_procesos_procesos1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espacios_x_procesos');
    }
};
