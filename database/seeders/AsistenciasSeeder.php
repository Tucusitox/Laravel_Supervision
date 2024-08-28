<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asistencia;

class AsistenciasSeeder extends Seeder
{
    public function run(): void
    {
        // INSERT EN LA TABLA "asistencias"
        Asistencia::insert([
            [
                'fk_empleado' => 1,
                'fecha_asistencia' => '2024-08-01',
                'hora_llegada' => '09:00:00',
                'hora_salida' => '17:00:00',
            ],
            [
                'fk_empleado' => 2,
                'fecha_asistencia' => '2024-08-01',
                'hora_llegada' => '01:30:00',
                'hora_salida' => '22:00:00',
            ],
            [
                'fk_empleado' => 3,
                'fecha_asistencia' => '2024-07-05',
                'hora_llegada' => '08:00:00',
                'hora_salida' => NULL,
            ],
            [
                'fk_empleado' => 4,
                'fecha_asistencia' => '2024-08-01',
                'hora_llegada' => '01:00:00',
                'hora_salida' => NULL,
            ],
            [
                'fk_empleado' => 1,
                'fecha_asistencia' => '2024-08-26',
                'hora_llegada' => '09:00:00',
                'hora_salida' => '22:00:00',
            ],
        ]);
    }
}
