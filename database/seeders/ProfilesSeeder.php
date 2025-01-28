<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //vamos a generarle el perfil.
        $profile = new Profile();
        $profile->Profiles_usersId = 1;
        $profile->Profiles_rolesId = 1;
        $profile->profiles_state = 1; //activo perfil
        $profile->save();

        $profile = new Profile();
        $profile->Profiles_usersId = 2;
        $profile->Profiles_rolesId = 2;
        $profile->profiles_state = 1; //activo perfil
        $profile->save();
    }
}
