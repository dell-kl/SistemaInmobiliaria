<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class RegistroPropiedad extends Component
{

    public function render()
    {
        return view('livewire.registro-propiedad');
    }

    //vamos a mostrar un mensaje de carga general.
    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <!-- Loading spinner... -->
            <p>Cargando Contenido ...</p>
        </div>
        HTML;
    }
}
