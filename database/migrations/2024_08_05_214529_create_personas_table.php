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
        Schema::create('personas', function (Blueprint $table) {
            $table->integer('id_persona', true);
            $table->integer('fk_genero')->index('fk_personas_generos_idx');
            $table->integer('fk_tipoIde')->index('fk_personas_tipos_identificaciones1_idx');
            $table->integer('identificacion')->unique('cedula_unique');
            $table->string('foto', 200);
            $table->string('nombre', 200);
            $table->string('apellido', 200);
            $table->date('fecha_nacimiento');
            $table->string('direccion', 200);
            $table->string('tlf_celular', 100);
            $table->string('tlf_local', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
