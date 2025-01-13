<?php
namespace App\Livewire;

use Livewire\Component;

class CarruselImagenes extends Component
{
    public $idPropiedad;

    public $recursosPropiedad;

    public $posicion = 0;

    public $mostrar = "d-none"; // esto gestiona la visisibilidad del carrusel.

    public $mostrarProyect = "d-block";
    public $mostrarPlanos = "d-none";
    public $mostrarVideos = "d-none";

    public function render()
    {
        return view('livewire.carrusel-imagenes');
    }

    public function verificarTipoRecurso($tipo) : void
    {
        if ( $tipo == 1 )
        {
            $this->mostrarProyect = "d-block";
            $this->mostrarPlanos = "d-none";
            $this->mostrarVideos = "d-none";
        }
        else if ( $tipo == 2 )
        {
            $this->mostrarProyect = "d-none";
            $this->mostrarPlanos = "d-block";
            $this->mostrarVideos = "d-none";
        }
        else
        {
            $this->mostrarProyect = "d-none";
            $this->mostrarPlanos = "d-none";
            $this->mostrarVideos = "d-block";
        }
        $this->posicion = 0;
        $this->mostrar = "d-block";
    }

    public function cerrar()
    {
        $this->mostrar = "d-none";
        $this->posicion = 0;
    }

    public function anterior()
    {
        if ( $this->posicion > 0 )
        {
            $this->posicion--;
            $this->mostrar = "d-block";
        }
    }

    public function siguiente()
    {

        if (
            ($this->mostrarProyect == "d-block" && $this->posicion <= count($this->recursosPropiedad["images"]) - 1 )
            ||
            ($this->mostrarPlanos == "d-block" && $this->posicion <= count($this->recursosPropiedad["planos"]) - 1)
            ||
            ($this->MostrarVideos == "d-block" && $this->posicion <= count($this->recursosPropiedad["videos"]) - 1)
        )
        {
            $this->posicion++;
        }

        dd($this->posicion);

        $this->mostrar = "d-block";
    }
}
