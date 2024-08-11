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
        Schema::table('evaluaciones_x_itemsespacios', function (Blueprint $table) {
            $table->foreign(['fk_evaluacion'], 'fk_evaluaciones_has_items_areas_evaluaciones1')->references(['id_evaluacion'])->on('evaluaciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_itemEspa'], 'fk_evaluaciones_has_items_areas_items_areas1')->references(['id_itemEspa'])->on('items_espacios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluaciones_x_itemsespacios', function (Blueprint $table) {
            $table->dropForeign('fk_evaluaciones_has_items_areas_evaluaciones1');
            $table->dropForeign('fk_evaluaciones_has_items_areas_items_areas1');
        });
    }
};
