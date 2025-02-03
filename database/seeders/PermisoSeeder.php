<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = new Permission();
        $permission->permissions_name = 'CREAR';
        $permission->permissions_state = 1;
        $permission->save();


        $permission = new Permission();
        $permission->permissions_name = 'ELIMINAR';
        $permission->permissions_state = 1;
        $permission->save();


        $permission = new Permission();
        $permission->permissions_name = 'EDITAR';
        $permission->permissions_state = 1;
        $permission->save();


        $permission = new Permission();
        $permission->permissions_name = 'VER';
        $permission->permissions_state = 1;
        $permission->save();
    }
}
