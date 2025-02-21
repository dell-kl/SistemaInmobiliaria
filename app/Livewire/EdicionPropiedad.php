<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\Attributes\On;

class EdicionPropiedad extends Component
{
    public $identificadorPropiedad;
    public $propiedad;

    public $token;

    public $mostrarPanel = false;

    public $autorizarEdicion = true;

    public $verificarFormularios = [
        "datosProyecto" => true,
        "datosUbicacion" => true
    ];

    public function render()
    {
        return view('livewire.edicion-propiedad');
    }

    #[On('formulario-edicion')]
    public function ListeningDispatchingForms($datos)
    {
        try {

            //code...
            $this->verificarFormularios[$datos['tipo']] = $datos['valor'];

            if (
                $this->verificarFormularios["datosProyecto"]
                &&
                $this->verificarFormularios["datosUbicacion"]
            )
            {
                $this->autorizarEdicion = true;
            }
            else
            {
                $this->autorizarEdicion = false;
            }

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

    /**
     * Dentro de este apartado vamos a crear un evento que nos permita mandar a llamar
     * uno que esta en escucha en la parte de las coordenadas.
     */
    public function setearMostrarPanel($entrada)
    {
        $this->mostrarPanel = $entrada;
    }

}


