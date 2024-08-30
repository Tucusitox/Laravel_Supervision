<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genero;
use App\Models\TiposIdentificacione;
use App\Models\TiposEmp;
use App\Models\Espacio;
use App\Models\Cargo;
use App\Models\Horario;
use App\Models\ItemsEmp;
use App\Models\TiposEventualidade;
use App\Models\TiposEstatusevent;

class SemillasSeeder extends Seeder
{
    public function run(): void
    {
        // INSERTAR DATOS EN LA TABLA "generos"
        Genero::insert([
            ['nombre_genero' => 'Masculino'],
            ['nombre_genero' => 'Femenino'],
        ]);

        // INSERTAR DATOS EN LA TABLA "tipos_identificaciones"
        TiposIdentificacione::insert([
            ['tipo_identificacion' => 'Venezolana'],
            ['tipo_identificacion' => 'Extranjera'],
            ['tipo_identificacion' => 'Júridica'],
        ]);

        // INSERTAR DATOS EN LA TABLA "tipos_emps"
        TiposEmp::insert([
            ['tipo_Empleado' => 'Fijo'],
            ['tipo_Empleado' => 'Contratado'],
            ['tipo_Empleado' => 'A destajo'],
        ]);

        // INSERTAR DATOS EN LA TABLA "espacios"
        Espacio::insert([
            ['nombre_espacio' => 'Almacen'],
            ['nombre_espacio' => 'Servicio'],
            ['nombre_espacio' => 'Cocina'],
            ['nombre_espacio' => 'Bar'],
            ['nombre_espacio' => 'Comedor'],
            ['nombre_espacio' => 'Estación de entregas'],
            ['nombre_espacio' => 'Todos'],
            ['nombre_espacio' => 'No aplica'],
        ]);

        // INSERTAR DATOS EN LA TABLA "cargos"
        Cargo::insert([
            ['fk_espacio' => 7, 'nombre_car' => 'Gerente'],
            ['fk_espacio' => 2, 'nombre_car' => 'Maître'],
            ['fk_espacio' => 5, 'nombre_car' => 'Mesero'],
            ['fk_espacio' => 4, 'nombre_car' => 'Bartender'],
            ['fk_espacio' => 2, 'nombre_car' => 'Recepcionista'],
            ['fk_espacio' => 3, 'nombre_car' => 'Cheft ejecutivo'],
            ['fk_espacio' => 3, 'nombre_car' => 'Jefe de cocina'],
            ['fk_espacio' => 3, 'nombre_car' => 'Sous chef'],
            ['fk_espacio' => 3, 'nombre_car' => 'Cocinero'],
            ['fk_espacio' => 3, 'nombre_car' => 'Asistente de cocina'],
            ['fk_espacio' => 1, 'nombre_car' => 'Almacenista'],
            ['fk_espacio' => 7, 'nombre_car' => 'Conserje'],
            ['fk_espacio' => 6, 'nombre_car' => 'Repartidor'],
            ['fk_espacio' => 8, 'nombre_car' => 'Abogado'],
        ]);

        // INSERTAR DATOS EN LA TABLA "horarios"
        Horario::insert([
            ['nombre_horario' => 'Mañana', 'descripcion_horario' => '8:00am a 1:00pm'],
            ['nombre_horario' => 'Tarde/Noche', 'descripcion_horario' => '1:00pm a 10:00pm'],
            ['nombre_horario' => 'Completo', 'descripcion_horario' => '8:00am a 10:00pm'],
            ['nombre_horario' => 'No Aplica', 'descripcion_horario' => 'El tiempo que se le necesite'],
        ]);

        // INSERTAR DATOS EN LA TABLA "items_emps"
        ItemsEmp::insert([
            ['item_empleado' => 'Higiene'],
            ['item_empleado' => 'Vestimenta'],
            ['item_empleado' => 'Buen trato al Cliente'],
            ['item_empleado' => 'Conocimiento de los Menús'],
            ['item_empleado' => 'Trabajo en Equipo'],
        ]);

        // INSERTAR DATOS EN LA TABLA "tipos_eventualidades"
        TiposEventualidade::insert([
            ['tipo_eventualidad' => 'Permiso'],
            ['tipo_eventualidad' => 'Incidencia'],
            ['tipo_eventualidad' => 'Falla'],
        ]);

        // INSERTAR DATOS EN LA TABLA "tipos_estatusEvent"
        TiposEstatusevent::insert([
            ['tipo_estatu' => 'Iniciado'],
            ['tipo_estatu' => 'En Proceso'],
            ['tipo_estatu' => 'Finalizado'],
            ['tipo_estatu' => 'No Aplica'],
        ]);
    }
}
