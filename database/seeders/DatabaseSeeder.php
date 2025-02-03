<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //dentro de este entorno, vamos a especificar el orden en que se crean.
        $this->call([
            RolesSeeder::class,
            PermisoSeeder::class,
            AuthorizationSeeder::class,
            UsersSeeder::class,
            ProfilesSeeder::class,
            TypePropertiesSeeder::class,
            CantonSeeder::class,
            ParroquiaSeeder::class
        ]);

    }
}
