<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;

class TipoCamposRegistroPropiedad extends Component
{
    public $typeProjects = 1;
    public $datosPropiedad;

    public function render()
    {
        return view('livewire.tipo-campos-registro-propiedad');
    }

    public function EventUpdateTypeProject($type)
    {
        $typeProjects = intval( $type );

    }
}
