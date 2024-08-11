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
        Schema::create('evaluaciones_x_itemsespacios', function (Blueprint $table) {
            $table->integer('id_eval_itemEspa', true);
            $table->integer('fk_evaluacion')->index('fk_evaluaciones_has_items_areas_evaluaciones1_idx');
            $table->integer('fk_itemEspa')->index('fk_evaluaciones_has_items_areas_items_areas1_idx');
            $table->integer('nota_itemEspacio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones_x_itemsespacios');
    }
};
