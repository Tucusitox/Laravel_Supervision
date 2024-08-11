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
        Schema::table('personas', function (Blueprint $table) {
            $table->foreign(['fk_genero'], 'fk_personas_generos')->references(['id_genero'])->on('generos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_tipoIde'], 'fk_personas_tipos_identificaciones1')->references(['id_tipoIde'])->on('tipos_identificaciones')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropForeign('fk_personas_generos');
            $table->dropForeign('fk_personas_tipos_identificaciones1');
        });
    }
};
