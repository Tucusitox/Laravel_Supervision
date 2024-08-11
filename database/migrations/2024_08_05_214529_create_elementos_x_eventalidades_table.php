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
        Schema::create('elementos_x_eventalidades', function (Blueprint $table) {
            $table->integer('id_elementEvent', true);
            $table->integer('fk_elementInfra')->index('fk_elementos_infraestructuras_has_eventalidades_elementos_i_idx');
            $table->integer('fk_eventualidad')->index('fk_elementos_infraestructuras_has_eventalidades_eventalidad_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos_x_eventalidades');
    }
};
