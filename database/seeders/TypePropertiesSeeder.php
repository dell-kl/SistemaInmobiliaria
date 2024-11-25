<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeProperty;

class TypePropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $TProperty = new TypeProperty();
        $TProperty->typeProperties_name = "casa";
        $TProperty->typeProperties_state = 1;
        $TProperty->save();

        $TProperty = new TypeProperty();
        $TProperty->typeProperties_name = "departamento";
        $TProperty->typeProperties_state = 1;
        $TProperty->save();

        $TProperty = new TypeProperty();
        $TProperty->typeProperties_name = "terreno";
        $TProperty->typeProperties_state = 1;
        $TProperty->save();
    }
}
