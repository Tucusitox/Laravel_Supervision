<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// ESTA CLASE ES PARA INGRESAR LOS DATOS DE TODOS LOS SEEDERS
class SupervisionSeeder extends Seeder
{
    public function run(): void
    {
        // IVOCANDO A TODOS LOS SEEDERS
        $this->call([
            SemillasSeeder::class, 
            PersonasSeeder::class, 
            EmpleadosSeeder::class, 
            AsistenciasSeeder::class, 
            PermisosSeeder::class, 
        ]);
    }
}
