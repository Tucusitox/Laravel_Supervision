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
        Schema::table('procesos_x_eventualidades', function (Blueprint $table) {
            $table->foreign(['fk_eventualidad'], 'fk_procesos_has_eventalidades_eventalidades1')->references(['id_eventualidad'])->on('eventualidades')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_proceso'], 'fk_procesos_has_eventalidades_procesos1')->references(['id_proceso'])->on('procesos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procesos_x_eventualidades', function (Blueprint $table) {
            $table->dropForeign('fk_procesos_has_eventalidades_eventalidades1');
            $table->dropForeign('fk_procesos_has_eventalidades_procesos1');
        });
    }
};
