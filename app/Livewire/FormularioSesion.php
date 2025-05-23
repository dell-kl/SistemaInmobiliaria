<?php

namespace App\Livewire;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Livewire\Component;

class FormularioSesion extends Component
{
    //vamos a definir unos atributos que podemos empezar a realizar cambios.
    public $email = "";

    public $password = "";

    public  $permitirSesion = "denegado";

    public $tipoAutenticacion = "Credenciales";

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|string|max:15|min:5',
    ];

    protected $messages = [
        'email.required' => 'Debes ingresar un correo electronico',
        'password.required' => 'Debes ingresar la contraseña',
        'email.email' => 'Debes ingresar un correo electronico valido',
        'password.min' => 'Debes ingresar una contraseña valida',
    ];

    public function render()
    {
        return view('livewire.formulario-sesion');
    }

    public function validarEntrada($entrada)
    {
        $resultado = $this->validate();

        if ( !empty($resultado) )
        {
            $this->permitirSesion = "autorizado";
        }

    }

    public function verificarTipoAutenticacion($tipo)
    {
        $this->tipoAutenticacion = $tipo;
    }
}
