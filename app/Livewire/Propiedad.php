<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;

class Propiedad extends Component
{
    public $property;
    public $rutaImagen;

    public function render()
    {
        return view('livewire.propiedad');
    }
}
