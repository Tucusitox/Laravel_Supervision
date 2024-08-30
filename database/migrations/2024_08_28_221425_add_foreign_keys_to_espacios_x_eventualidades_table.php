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
        Schema::table('espacios_x_eventualidades', function (Blueprint $table) {
            $table->foreign(['fk_espacio'], 'fk_areas_has_eventualidades_areas1')->references(['id_espacio'])->on('espacios')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_eventualidad'], 'fk_areas_has_eventualidades_eventualidades1')->references(['id_eventualidad'])->on('eventualidades')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('espacios_x_eventualidades', function (Blueprint $table) {
            $table->dropForeign('fk_areas_has_eventualidades_areas1');
            $table->dropForeign('fk_areas_has_eventualidades_eventualidades1');
        });
    }
};
