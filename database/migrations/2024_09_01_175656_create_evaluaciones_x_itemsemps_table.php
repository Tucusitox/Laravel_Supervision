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
        Schema::create('evaluaciones_x_itemsemps', function (Blueprint $table) {
            $table->integer('id_eval_itemEmp', true);
            $table->integer('fk_evaluacion')->index('fk_evaluaciones_has_items_emps_evaluaciones1_idx');
            $table->integer('fk_itemEmp')->index('fk_evaluaciones_has_items_emps_items_emps1_idx');
            $table->integer('nota_itemEmpleado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones_x_itemsemps');
    }
};
