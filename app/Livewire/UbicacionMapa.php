<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class UbicacionMapa extends Component
{
    public string $identificador;
    public string $coordenadas;

    public function verificarCoordenadas()
    {
        dd('datos....');
    }

    public function render()
    {
        return view('livewire.ubicacion-mapa');
    }

}
