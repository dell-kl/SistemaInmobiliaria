<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //vamos a crear un usuario ...
        $user = new User();
        $user->users_name = 'David Sanchez';
        $user->users_phone = '0933898999';
        $user->users_cedula = '1754090106';
        $user->users_email = 'david07@hotmail.com';
        $user->password = Hash::make('123456789');
        $user->users_intentos = 3;
        $user->users_estado = 'activo';

        $user->save();

        $user = new User();
        $user->users_name = 'Juan Carlos';
        $user->users_phone = '0933898999';
        $user->users_cedula = '1754090106';
        $user->users_email = 'juan@hotmail.com';
        $user->password = Hash::make('123456789');
        $user->users_intentos = 3;
        $user->users_estado = 'activo';
        $user->save();

        $user = new User();
        $user->users_name = 'Marco Antonio';
        $user->users_phone = '0933898999';
        $user->users_cedula = '1102935341';
        $user->users_email = 'marco07@hotmail.com';
        $user->password = Hash::make('123456789');
        $user->users_intentos = 3;
        $user->users_estado = 'activo';
        $user->save();
    }
}
