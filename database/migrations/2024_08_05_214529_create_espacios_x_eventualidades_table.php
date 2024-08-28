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
        Schema::create('espacios_x_eventualidades', function (Blueprint $table) {
            $table->integer('id_espaEvent', true);
            $table->integer('fk_espacio')->index('fk_areas_has_eventualidades_areas1_idx');
            $table->integer('fk_eventualidad')->index('fk_areas_has_eventualidades_eventualidades1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espacios_x_eventualidades');
    }
};
