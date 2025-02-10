<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class RegistroPropiedad extends Component
{
    public $autorizarRegistro = false;

    public $verificarFormularios = [
        "imgProyecto" => false,
        "datosProyecto" => false,
        "imgPlanos" => false,
        "coordenadas" => false,
        "datosUbicacion" => false
    ];



    public function render()
    {
        return view('livewire.registro-propiedad');
    }


    /**
     * Aqui agregaremos un metodo que escucha por un evento...
     * Este de aqui nos avisara si todos los datos ya fueron respectivamente llenados dentro
     * del formulario para permitir el acceso al registro de la propiedad.
     */
    #[On('formulario-registro')]
    public function ListeningDispatchingForms($datos)
    {
        try {
            //code...
            $this->verificarFormularios[$datos['tipo']] = $datos['valor'];

            if (
                $this->verificarFormularios["imgProyecto"]
                // &&
                // $this->verificarFormularios["datosProyecto"] &&
                // $this->verificarFormularios["imgPlanos"] &&
                // $this->verificarFormularios["coordenadas"] &&
                // $this->verificarFormularios["datosUbicacion"]
            )
            {
                $this->autorizarRegistro = true;
            }

            $this->render();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }

    }
}
