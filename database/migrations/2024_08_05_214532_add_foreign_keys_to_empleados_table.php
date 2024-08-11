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
        Schema::table('empleados', function (Blueprint $table) {
            $table->foreign(['fk_cargo'], 'fk_empleados_cargos1')->references(['id_cargo'])->on('cargos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_persona'], 'fk_empleados_personas1')->references(['id_persona'])->on('personas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_tipo_emp'], 'fk_empleados_tipos_emp1')->references(['id_tipo_emp'])->on('tipos_emps')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropForeign('fk_empleados_cargos1');
            $table->dropForeign('fk_empleados_personas1');
            $table->dropForeign('fk_empleados_tipos_emp1');
        });
    }
};
