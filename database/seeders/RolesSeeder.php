<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //vamos a poner los respectivos datos para roles
        $rol_1 = new Role();
        $rol_1->roles_name = 'administrador';
        $rol_1->roles_estado = 1;
        $rol_1->save();

        $rol_2 = new Role();
        $rol_2->roles_name = 'agente_inmobiliaria';
        $rol_2->roles_estado = 1;
        $rol_2->save();

        $rol_3 = new Role();
        $rol_3->roles_name = 'soporte_tecnico';
        $rol_3->roles_estado = 1;
        $rol_3->save();

        $rol_4 = new Role();
        $rol_4->roles_name = 'cliente';
        $rol_4->roles_estado = 1;
        $rol_4->save();
    }
}
