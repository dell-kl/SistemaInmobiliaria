<?php

namespace App\Livewire;

use Livewire\Component;

class SubidaArchivo extends Component
{
    public $tipoSubidaArchivo;
    public $widthProperty;
    public $heightProperty;
    public $mensaje;
    public $subtitulo;

    public function render()
    {

        return view('livewire.subida-archivo');
    }
}
