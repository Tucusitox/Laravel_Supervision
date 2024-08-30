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
        Schema::table('procesos_x_horarios', function (Blueprint $table) {
            $table->foreign(['fk_horario'], 'fk_procesos_has_horarios_horarios1')->references(['id_horario'])->on('horarios')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_proceso'], 'fk_procesos_has_horarios_procesos1')->references(['id_proceso'])->on('procesos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procesos_x_horarios', function (Blueprint $table) {
            $table->dropForeign('fk_procesos_has_horarios_horarios1');
            $table->dropForeign('fk_procesos_has_horarios_procesos1');
        });
    }
};
