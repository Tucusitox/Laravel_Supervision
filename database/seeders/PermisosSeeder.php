<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Eventualidade;
use App\Models\EmpleadosXEventualidade;

class PermisosSeeder extends Seeder
{
    public function run(): void
    {
        Eventualidade::insert([
            [
                'fk_tipoEvent' => 1,
                'fk_tipoEstatusEvent' => 4,
                'codigo_event' => 'P-3342',
                'asunto_event' => 'Reposo Médico',
                'descripcion_event' => 'Por la presente, solicito un permiso médico desde el 1 de agosto de 2024 hasta el 5 de agosto de 2024. Este tiempo es necesario para atender asuntos de salud que requieren mi atención personal. Agradezco su comprensión y apoyo en este asunto.',
                'fecha_inicioEvent' => '2024-08-01',
                'fecha_finEvent' => '2024-08-05',
                'fechaCreacion_event' => '2024-07-31',
            ],
            [
                'fk_tipoEvent' => 1,
                'fk_tipoEstatusEvent' => 4,
                'codigo_event' => 'P-2214',
                'asunto_event' => 'Mudanza',
                'descripcion_event' => 'Solicito permiso para no asistir los días 05/08/2024 y 06/08/2024 debido a que me voy a mudar de residencia a una zona más centrica.',
                'fecha_inicioEvent' => '2024-08-05',
                'fecha_finEvent' => '2024-08-06',
                'fechaCreacion_event' => '2024-08-03',
            ],
            [
                'fk_tipoEvent' => 1,
                'fk_tipoEstatusEvent' => 4,
                'codigo_event' => 'P-9943',
                'asunto_event' => 'Salida Temprana',
                'descripcion_event' => 'Solicito permiso para salir una hora antes el día 12/08/2024, debido a que tengo que inscribirme en la universidad.',
                'fecha_inicioEvent' => '2024-08-12',
                'fecha_finEvent' => '2024-08-12',
                'fechaCreacion_event' => '2024-08-11',
            ],
            [
                'fk_tipoEvent' => 1,
                'fk_tipoEstatusEvent' => 4,
                'codigo_event' => 'P-4531',
                'asunto_event' => 'Asuntos Personales',
                'descripcion_event' => 'Por la presente, solicito un permiso para poder ir a la fiscalia por la custodia de mi hijo.',
                'fecha_inicioEvent' => '2024-08-03',
                'fecha_finEvent' => '2024-08-03',
                'fechaCreacion_event' => '2024-08-01',
            ],
        ]);

        // INSERT EN LA TABLA "empleados_x_eventualidades"
        EmpleadosXEventualidade::insert([
            [
                'fk_empleado' => 1,
                'fk_eventualidad' => 1,
            ],
            [
                'fk_empleado' => 2,
                'fk_eventualidad' => 2,
            ],
            [
                'fk_empleado' => 3,
                'fk_eventualidad' => 3,
            ],
            [
                'fk_empleado' => 1,
                'fk_eventualidad' => 4,
            ],
        ]);
    }
}
