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
        Schema::create('procesos_x_horarios', function (Blueprint $table) {
            $table->integer('id_procesoHorario', true);
            $table->integer('fk_proceso')->index('fk_procesos_has_horarios_procesos1_idx');
            $table->integer('fk_horario')->index('fk_procesos_has_horarios_horarios1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procesos_x_horarios');
    }
};
