<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persona;

class PersonasSeeder extends Seeder
{
    public function run(): void
    {
        // INSERT PARA LA TABLA "personas"
        Persona::insert([
            [
                'fk_genero' => 1,
                'fk_tipoIde' => 1,
                'identificacion' => '27995612',
                'foto' => 'img/fotosEmps/Yuta Starboy.jpg',
                'nombre' => 'José Daniel',
                'apellido' => 'Morian Pérez',
                'fecha_nacimiento' => '2001-07-16',
                'direccion' => 'Urb. Ezequiel Zamora, Ciudad Tiuna, Torre-37, Piso-4. Apt-C',
                'tlf_celular' => '04128135349',
                'tlf_local' => '02126836380',
            ],
            [
                'fk_genero' => 2,
                'fk_tipoIde' => 2,
                'identificacion' => '13445789',
                'foto' => 'img/fotosEmps/mujer.jpg',
                'nombre' => 'María Alejandra',
                'apellido' => 'Gómez Castillo',
                'fecha_nacimiento' => '1992-02-02',
                'direccion' => 'Avenida Siempre Viva 456, Calle 40, Casa N5',
                'tlf_celular' => '04243356712',
                'tlf_local' => '02124451234',
            ],
            [
                'fk_genero' => 2,
                'fk_tipoIde' => 1,
                'identificacion' => '27031770',
                'foto' => 'img/fotosEmps/mujer.jpg',
                'nombre' => 'Katherine Bella',
                'apellido' => 'Navas Divina',
                'fecha_nacimiento' => '1988-03-03',
                'direccion' => 'Boulevard de los Sueños Rotos 789, Rinconada Edifico N5, Piso-4, Apt-E',
                'tlf_celular' => '04242574379',
                'tlf_local' => '02122231256',
            ],
            [
                'fk_genero' => 1,
                'fk_tipoIde' => 2,
                'identificacion' => '30011342',
                'foto' => 'img/fotosEmps/hombre.jpg',
                'nombre' => 'Cleiver Alejandro',
                'apellido' => 'Jimenez Martínez',
                'fecha_nacimiento' => '2001-04-09',
                'direccion' => 'Calle de la Amargura 321, Propatria, Calle Muert, Casa 666',
                'tlf_celular' => '04125821368',
                'tlf_local' => '02125564789',
            ],
            [
                'fk_genero' => 1,
                'fk_tipoIde' => 1,
                'identificacion' => '27334127',
                'foto' => 'img/fotosEmps/roronoaZoro.jpg',
                'nombre' => 'Zoro Roronoa',
                'apellido' => 'Yonko Verde',
                'fecha_nacimiento' => '1985-05-05',
                'direccion' => 'Sunny Go, Isla del Sake, Nuevo Mundo. Rumbo a Elbaf',
                'tlf_celular' => '04243312367',
                'tlf_local' => '02125567832',
            ],
        ]);
    }
}
