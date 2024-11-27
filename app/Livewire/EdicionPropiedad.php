<?php

namespace App\Livewire;

use Livewire\Component;

class EdicionPropiedad extends Component
{
    public $identificadorPropiedad;

    public function render()
    {
        return view('livewire.edicion-propiedad');
    }
}
