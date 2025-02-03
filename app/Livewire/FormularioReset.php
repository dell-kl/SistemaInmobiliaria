<?php

namespace App\Livewire;

use Livewire\Component;

class FormularioReset extends Component
{
    //vamos a reestablecer con ayuda de nuestro correo electronico.
    public $email;
    public $permitirSesion = "denegado";

    //validacion de los campos.
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo electronico es requerido',
            'email.string' => 'El correo electronico debe ser una cadena de texto',
            'email.email' => 'El correo electronico debe ser una direccion email valida',
        ];
    }

    public function validarCampos($campo)
    {
        $resultado = $this->validateOnly($campo);

        if ( !empty($resultado) )
        {
            $this->permitirSesion = "autorizado";
        }
    }

    public function render()
    {
        return view('livewire.formulario-reset');
    }
}
