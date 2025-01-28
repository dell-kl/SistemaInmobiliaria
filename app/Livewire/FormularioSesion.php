<?php

namespace App\Livewire;

use Livewire\Component;

class FormularioSesion extends Component
{
    //vamos a definir unos atributos que podemos empezar a realizar cambios.
    public $email = "";
    public $password = "";

    public  $botonConfirmar = "disabled";

    public function render()
    {

        return view('livewire.formulario-sesion');
    }

    public function validarCampos()
    {
        if ( !empty($this->email) && !empty($this->password) )
        {
            $this->botonConfirmar = "";
        }


    }
}
