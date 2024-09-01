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
        Schema::table('procesos', function (Blueprint $table) {
            $table->foreign(['fk_tipoProces'], 'fk_procesos_tipos_procesos1')->references(['id_tipoProces'])->on('tipos_procesos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procesos', function (Blueprint $table) {
            $table->dropForeign('fk_procesos_tipos_procesos1');
        });
    }
};
