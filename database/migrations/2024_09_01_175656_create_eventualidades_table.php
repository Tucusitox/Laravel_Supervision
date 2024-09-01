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
        Schema::create('eventualidades', function (Blueprint $table) {
            $table->integer('id_eventualidad', true);
            $table->integer('fk_tipoEvent')->index('fk_eventalidades_tipos_eventualidades1_idx');
            $table->integer('fk_tipoEstatusEvent')->index('fk_eventualidades_tipos_estatus1_idx');
            $table->string('codigo_event', 100)->unique('codigo_event_unique');
            $table->string('asunto_event', 100);
            $table->string('descripcion_event', 700);
            $table->date('fecha_inicioEvent');
            $table->date('fecha_finEvent')->nullable();
            $table->date('fechaCreacion_event');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventualidades');
    }
};
