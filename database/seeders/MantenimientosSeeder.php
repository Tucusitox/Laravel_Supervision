<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Eventualidade;
use App\Models\ElementosXEventalidade;

class MantenimientosSeeder extends Seeder
{
    public function run(): void
    {
        Eventualidade::insert([
            [
                'fk_tipoEvent' => 3,
                'fk_tipoEstatusEvent' => 1,
                'codigo_event' => 'F-3421',
                'asunto_event' => 'Falla en el sistema de refrigeración de la nevera del restaurante',
                'descripcion_event' => 'La nevera del restaurante ha dejado de funcionar correctamente, lo que ha provocado un aumento en la temperatura interna y un potencial riesgo de deterioro de los alimentos almacenados. Se requiere una revisión urgente del sistema de refrigeración para evitar pérdidas y garantizar la seguridad alimentaria.',
                'fecha_inicioEvent' => '2024-09-03',
                'fecha_finEvent' => null,
                'fechaCreacion_event' => '2024-09-03',
            ],
            [
                'fk_tipoEvent' => 3,
                'fk_tipoEstatusEvent' => 3,
                'codigo_event' => 'F-2411',
                'asunto_event' => 'Falla en la mesa del restaurante',
                'descripcion_event' => 'La mesa del restaurante presenta un problema de estabilidad, lo que provoca que se balancee y no se mantenga en una posición firme. Esto afecta la experiencia de los clientes y puede resultar en accidentes. Se necesita una revisión y reparación inmediata para garantizar la seguridad y comodidad de los comensales.',
                'fecha_inicioEvent' => '2024-09-03',
                'fecha_finEvent' => '2024-09-04',
                'fechaCreacion_event' => '2024-09-03',
            ],
        ]);

        // INSERTAR DATOS EN TABLA "elementos_x_eventualidades"
        ElementosXEventalidade::insert([
            [
                'fk_elementInfra' => 1,
                'fk_eventualidad' => 5,
            ],
            [
                'fk_elementInfra' => 2,
                'fk_eventualidad' => 6,
            ],
        ]);
    }
}
