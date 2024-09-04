<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ElementosInfraestructura;

class InfraestructuraSeeder extends Seeder
{
    public function run(): void
    {
        // INSERTAR DATOS EN TABLA "elementos_infraestructuras"
        ElementosInfraestructura::insert([
            [
                'fk_tipoElement' => 2,
                'fk_espacio' => 3,
                'nombre_element' => 'Nevera Lenovo x234',
                'descripcion_element' => 'Se ha adquirido una nueva nevera de la marca Lenovo y se requiere asistencia para su correcta instalación. Es importante asegurarse de que el enchufe esté en buen estado y que la nevera esté conectada a una toma de corriente adecuada para garantizar su funcionamiento óptimo y prolongar su vida útil.',
            ],
            [
                'fk_tipoElement' => 3,
                'fk_espacio' => 2,
                'nombre_element' => 'Mesa Bugatt',
                'descripcion_element' => 'Se ha adquirido una nueva mesa para el salón VIP del restaurante, diseñada para ofrecer un ambiente exclusivo y cómodo para nuestros clientes. Esta mesa no solo mejora la estética del espacio, sino que también proporciona un área adecuada para disfrutar de una experiencia gastronómica de alta calidad. Se requiere su instalación y disposición adecuada para maximizar la comodidad y el servicio en esta zona privilegiada.',
            ],
            [
                'fk_tipoElement' => 4,
                'fk_espacio' => 1,
                'nombre_element' => 'Transporte de Carga Torton',
                'descripcion_element' => 'Se ha adquirido un nuevo vehículo para el transporte de carga, diseñado para optimizar la logística y mejorar la eficiencia en la entrega de mercancías. Este transporte cuenta con tecnología avanzada y capacidad adecuada para manejar diferentes tipos de carga, garantizando seguridad y puntualidad en las operaciones de distribución. Se requiere su integración en la flota existente y capacitación del personal para su uso adecuado.',
            ],
        ]);
    }
}
