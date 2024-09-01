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
        Schema::create('evaluaciones_x_itemsprocesos', function (Blueprint $table) {
            $table->integer('eval_itemProceso', true);
            $table->integer('fk_evaluacion')->index('fk_evaluaciones_has_items_procesos_evaluaciones1_idx');
            $table->integer('fk_itemProceso')->index('fk_evaluaciones_has_items_procesos_items_procesos1_idx');
            $table->integer('nota_itemProceso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones_x_itemsprocesos');
    }
};
