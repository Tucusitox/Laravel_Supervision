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
        Schema::table('evaluaciones_x_itemselementosinfra', function (Blueprint $table) {
            $table->foreign(['fk_evaluacion'], 'fk_evaluaciones_has_items_elementos_infraestructuras_evaluaci1')->references(['id_evaluacion'])->on('evaluaciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_itemElement'], 'fk_evaluaciones_has_items_elementos_infraestructuras_items_el1')->references(['id_itemElement'])->on('items_elementos_infraestructuras')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluaciones_x_itemselementosinfra', function (Blueprint $table) {
            $table->dropForeign('fk_evaluaciones_has_items_elementos_infraestructuras_evaluaci1');
            $table->dropForeign('fk_evaluaciones_has_items_elementos_infraestructuras_items_el1');
        });
    }
};
