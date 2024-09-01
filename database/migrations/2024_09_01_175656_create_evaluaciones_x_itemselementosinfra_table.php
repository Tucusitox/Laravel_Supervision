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
        Schema::create('evaluaciones_x_itemselementosinfra', function (Blueprint $table) {
            $table->integer('eval_itemElement', true);
            $table->integer('fk_evaluacion')->index('fk_evaluaciones_has_items_elementos_infraestructuras_evalua_idx');
            $table->integer('fk_itemElement')->index('fk_evaluaciones_has_items_elementos_infraestructuras_items__idx');
            $table->integer('nota_itemElemento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones_x_itemselementosinfra');
    }
};
