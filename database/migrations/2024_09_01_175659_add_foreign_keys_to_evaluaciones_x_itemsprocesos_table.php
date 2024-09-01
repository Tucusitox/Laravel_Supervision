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
        Schema::table('evaluaciones_x_itemsprocesos', function (Blueprint $table) {
            $table->foreign(['fk_evaluacion'], 'fk_evaluaciones_has_items_procesos_evaluaciones1')->references(['id_evaluacion'])->on('evaluaciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_itemProceso'], 'fk_evaluaciones_has_items_procesos_items_procesos1')->references(['id_itemProceso'])->on('items_procesos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluaciones_x_itemsprocesos', function (Blueprint $table) {
            $table->dropForeign('fk_evaluaciones_has_items_procesos_evaluaciones1');
            $table->dropForeign('fk_evaluaciones_has_items_procesos_items_procesos1');
        });
    }
};
