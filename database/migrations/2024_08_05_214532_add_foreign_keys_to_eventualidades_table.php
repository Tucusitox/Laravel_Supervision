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
        Schema::table('eventualidades', function (Blueprint $table) {
            $table->foreign(['fk_tipoEvent'], 'fk_eventalidades_tipos_eventualidades1')->references(['id_tipoEvent'])->on('tipos_eventualidades')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_tipoEstatusEvent'], 'fk_eventualidades_tipos_estatus1')->references(['id_tipoEstatusEvent'])->on('tipos_estatusevent')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventualidades', function (Blueprint $table) {
            $table->dropForeign('fk_eventalidades_tipos_eventualidades1');
            $table->dropForeign('fk_eventualidades_tipos_estatus1');
        });
    }
};
