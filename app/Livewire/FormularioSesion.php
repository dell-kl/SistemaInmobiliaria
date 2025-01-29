<?php

namespace App\Livewire;

use Livewire\Component;

class FormularioSesion extends Component
{
    //vamos a definir unos atributos que podemos empezar a realizar cambios.

    public $email = "";

    public $password = "";

    public  $permitirSesion = "denegado";

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|string|max:15|min:5',
    ];

    public function render()
    {
        $this->validate($this->rules);

        return view('livewire.formulario-sesion');
    }

}
