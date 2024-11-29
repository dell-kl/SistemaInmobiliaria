<?php

namespace Database\Seeders;

use App\Models\Canton;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CantonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $canton = new Canton();
        $canton->cantons_nombre = 'Quito';
        $canton->cantons_estado = 1;
        $canton->save();
        
    }
}
