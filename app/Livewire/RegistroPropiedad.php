<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class RegistroPropiedad extends Component
{

    /**
     * Validacion de los campos para registrar nuestra propiedad.
     */


    public $banos = "";
    public $estacionamiento = 0;
    public $area = "";
    public $altoProfunidad = "";
    public $disponibilidad = "";
    public $precio = 0;
    public $descripcion = "";
    public $codigoVideo = "";


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
