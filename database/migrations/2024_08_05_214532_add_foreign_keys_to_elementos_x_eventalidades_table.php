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
        Schema::table('elementos_x_eventalidades', function (Blueprint $table) {
            $table->foreign(['fk_elementInfra'], 'fk_elementos_infraestructuras_has_eventalidades_elementos_inf1')->references(['id_elementInfra'])->on('elementos_infraestructuras')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_eventualidad'], 'fk_elementos_infraestructuras_has_eventalidades_eventalidades1')->references(['id_eventualidad'])->on('eventualidades')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('elementos_x_eventalidades', function (Blueprint $table) {
            $table->dropForeign('fk_elementos_infraestructuras_has_eventalidades_elementos_inf1');
            $table->dropForeign('fk_elementos_infraestructuras_has_eventalidades_eventalidades1');
        });
    }
};
