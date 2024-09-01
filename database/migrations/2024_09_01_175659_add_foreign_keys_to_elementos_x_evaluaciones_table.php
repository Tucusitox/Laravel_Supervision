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
        Schema::table('elementos_x_evaluaciones', function (Blueprint $table) {
            $table->foreign(['fk_elementInfra'], 'fk_evaluaciones_has_elementos_infraestructuras_elementos_infr1')->references(['id_elementInfra'])->on('elementos_infraestructuras')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_evaluacion'], 'fk_evaluaciones_has_elementos_infraestructuras_evaluaciones1')->references(['id_evaluacion'])->on('evaluaciones')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('elementos_x_evaluaciones', function (Blueprint $table) {
            $table->dropForeign('fk_evaluaciones_has_elementos_infraestructuras_elementos_infr1');
            $table->dropForeign('fk_evaluaciones_has_elementos_infraestructuras_evaluaciones1');
        });
    }
};
