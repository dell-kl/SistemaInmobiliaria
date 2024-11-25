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
        $user->users_password = Hash::make('123456789');
        $user->save();
    }
}
