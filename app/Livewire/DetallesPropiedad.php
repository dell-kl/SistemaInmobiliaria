<?php

namespace App\Livewire;

use Livewire\Component;

class DetallesPropiedad extends Component
{

    public $idPropiedad;

    public $propiedad;

    public function render()
    {
        return view('livewire.detalles-propiedad');
    }
}
