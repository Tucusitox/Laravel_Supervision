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
        Schema::create('procesos', function (Blueprint $table) {
            $table->integer('id_proceso', true);
            $table->integer('fk_tipoProces')->index('fk_procesos_tipos_procesos1_idx');
            $table->string('codigo_proces', 100)->unique('codigo_proces_unique');
            $table->string('asunto_proceso', 200);
            $table->string('descripcion_proces', 1000);
            $table->time('tiempo_duracion');
            $table->date('fecha_proceso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procesos');
    }
};
