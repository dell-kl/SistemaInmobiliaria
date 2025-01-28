<?php

namespace App\Livewire;

use Livewire\Component;

class GaleriaImagenes extends Component
{

    public $idPropiedad;
    public $imagenes;

    public function render()
    {
        return view('livewire.galeria-imagenes');
    }
}
