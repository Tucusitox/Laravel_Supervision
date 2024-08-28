<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;
use App\Models\HorariosXEmpleado;

class EmpleadosSeeder extends Seeder
{
    public function run(): void
    {
        // INSERT PARA LA TABLA "empleados"
        Empleado::insert([
            [
                'fk_persona' => 1,
                'fk_tipo_emp' => 1,
                'fk_cargo' => 1,
                'estado_laboral' => 'Activo',
                'fecha_ingreso' => '2024-01-01',
                'fecha_egreso' => null,
            ],
            [
                'fk_persona' => 2,
                'fk_tipo_emp' => 2,
                'fk_cargo' => 2,
                'estado_laboral' => 'Activo',
                'fecha_ingreso' => '2024-02-01',
                'fecha_egreso' => null,
            ],
            [
                'fk_persona' => 3,
                'fk_tipo_emp' => 3,
                'fk_cargo' => 3,
                'estado_laboral' => 'Inactivo',
                'fecha_ingreso' => '2024-03-01',
                'fecha_egreso' => '2024-06-01',
            ],
            [
                'fk_persona' => 4,
                'fk_tipo_emp' => 2,
                'fk_cargo' => 1,
                'estado_laboral' => 'Inactivo',
                'fecha_ingreso' => '2024-04-01',
                'fecha_egreso' => null,
            ],
            [
                'fk_persona' => 5,
                'fk_tipo_emp' => 2,
                'fk_cargo' => 12,
                'estado_laboral' => 'Activo',
                'fecha_ingreso' => '2024-05-01',
                'fecha_egreso' => '2024-08-11',
            ],
        ]);

        // INSERT PARA LA TABLA "horarios_x_empelados"
        HorariosXEmpleado::insert([
            [
                'fk_horario' => 3,
                'fk_empleado' => 1,
            ],
            [
                'fk_horario' => 2,
                'fk_empleado' => 2,
            ],
            [
                'fk_horario' => 3,
                'fk_empleado' => 3,
            ],
            [
                'fk_horario' => 1,
                'fk_empleado' => 4,
            ],
            [
                'fk_horario' => 2,
                'fk_empleado' => 5,
            ],
        ]);
    }
}
