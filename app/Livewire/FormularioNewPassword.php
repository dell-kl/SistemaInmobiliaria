<?php

namespace App\Livewire;

use Livewire\Component;

class FormularioNewPassword extends Component
{

    //este token nos servira mucho porque contiene nuestro email de la persona que solicito el cambio....
    public $token;

    //setear nuestras primeras variables generales que validaran por la parte del frontend.
    public $password;
    public $password_confirmation;

    public $permitirSesion = "denegado";

    protected $rules = [
        'password' => 'required|string|min:5',
        'password_confirmation' => 'required|string|min:5',
    ];

    protected $messages = [
        'password.required' => 'El password es obligatorio',
        'password.string' => 'El password debe ser una cadena de texto',
        'password.min' => 'El password debe tener al menos 5 caracteres',
        'password_confirmation.required' => 'La confirmacion del password es obligatorio',
        'password_confirmation.string' => 'La confirmacion del password debe ser una cadena de texto',
        'password_confirmation.min' => 'La confirmacion del password debe tener al menos 5 caracteres',
    ];

    public function render()
    {
        //vamos a realizar una comparacion
        if ( $this->password == $this->password_confirmation )
        {
            $this->permitirSesion = "autorizado";
        }

        return view('livewire.formulario-new-password');
    }

    public function validacionCampos($campo)
    {
        $this->validateOnly($campo);
    }
}
