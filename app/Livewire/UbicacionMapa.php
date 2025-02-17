<?php

namespace App\Livewire;

use Livewire\Component;

class UbicacionMapa extends Component
{
    public string $identificador;
    public string $coordenadas;


    public function verificarCoordenadas()
    {
        dd($this->coordenadas);
    }

    public function render()
    {
        return view('livewire.ubicacion-mapa');
    }

}
