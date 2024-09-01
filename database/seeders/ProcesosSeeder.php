<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proceso;
use App\Models\EspaciosXProceso;

class ProcesosSeeder extends Seeder
{
    public function run(): void
    {
        // INSERTAR DATOS EN TABLA "procesos"
        Proceso::insert([
            [
                'fk_tipoProces' => 3,
                'codigo_proces' => 'PR-5335',
                'asunto_proceso' => 'Cantidad de Comidas Preparadas',
                'descripcion_proces' => 'Este proceso se enfoca en la transformación de materias primas en platos listos para servir. Incluye varias etapas, desde la recepción de insumos, su almacenamiento adecuado, hasta la preparación y presentación final de los alimentos. La eficiencia en este proceso es crucial para garantizar la calidad del servicio y la satisfacción del cliente. Se busca optimizar cada fase, minimizando tiempos de espera y desperdicios, lo que contribuye a una mejor rentabilidad y operatividad del restaurante.',
                'tiempo_duracion' => '00:40:11',
                'fecha_proceso' => "2024-09-02",
            ],
            [
                'fk_tipoProces' => 3,
                'codigo_proces' => 'PR-7466',
                'asunto_proceso' => 'Nivel de Producción en el Restaurante',
                'descripcion_proces' => 'El proceso de producción en un restaurante implica la selección de proveedores adecuados que garanticen la calidad de los ingredientes, así como la planificación y organización de las operaciones en la cocina. Este proceso es crucial para asegurar que los platos se preparen de manera eficiente y cumplan con los estándares de calidad esperados por los clientes. La implementación de protocolos de producción bien definidos puede mejorar la satisfacción del cliente y optimizar el uso de recursos, permitiendo que el restaurante funcione de manera más fluida y efectiva. Además, técnicas como el Cook and Chill permiten realizar producciones anticipadas, lo que facilita un servicio más eficiente y estandarizado.',
                'tiempo_duracion' => '01:40:24',
                'fecha_proceso' => "2024-09-02",
            ],
            [
                'fk_tipoProces' => 2,
                'codigo_proces' => 'PR-3421',
                'asunto_proceso' => 'Gestión de Recursos en el Restaurante',
                'descripcion_proces' => 'Este proceso se centra en la administración eficiente de los recursos humanos y materiales dentro del restaurante. Incluye la planificación y organización del personal, asegurando que cada empleado esté capacitado y motivado para ofrecer un servicio excepcional. Además, se gestionan los insumos y equipos necesarios para la operación diaria, optimizando costos y minimizando desperdicios. Una buena gestión de recursos es fundamental para crear un ambiente laboral positivo y garantizar una experiencia memorable para los clientes, lo que a su vez contribuye al éxito del negocio.',
                'tiempo_duracion' => '04:00:00',
                'fecha_proceso' => "2024-09-01",
            ]
        ]);
        // INSERTAR DATOS EN TABLA "espacios_x_procesos"
        EspaciosXProceso::insert([
            [
                'fk_espacio' => 7,
                'fk_proceso' => 1,
            ],
            [
                'fk_espacio' => 3,
                'fk_proceso' => 2,
            ],
            [
                'fk_espacio' => 2,
                'fk_proceso' => 3,
            ],
        ]);
    }
}
