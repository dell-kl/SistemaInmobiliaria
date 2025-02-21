<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class UbicacionMapa extends Component
{
    public string $identificador;
    public string $coordenadas;

    // #[On("registro-coordenadas.{identificador}")]
    // public function verificarCoordenadas()
    // {
    //     if ( !isset($this->coordenadas) )
    //     {
    //         $this->coordenadas = "0,0";
    //     }

    //     $this->dispatch('cargar-mapa', ['identificador' => $this->identificador, 'coordenadas' => $this->coordenadas]);
    // }



    public function render()
    {
        return view('livewire.ubicacion-mapa');
    }

}
