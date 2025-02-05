<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;

class EdicionPropiedad extends Component
{
    public $identificadorPropiedad;
    public $propiedad;

    public $token;

    public function render()
    {
        return view('livewire.edicion-propiedad');
    }
}
