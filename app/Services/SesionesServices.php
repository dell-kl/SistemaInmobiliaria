<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SesionesServices {
    public function __construct() {}

    public function verificarDatos($email, $password) : User|null {
        //primero comparemos si existe el email.
        $usuario = User::where('users_email', $email)->get()->first();

        if (isset($usuario)) {
            if (Hash::check($password, $usuario->users_password)) {

                // The passwords match...
                return $usuario;
            }
        }

        return null;
    }
}

?>
