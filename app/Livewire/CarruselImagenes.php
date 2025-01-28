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

    /*  =====================================================================================
        debemos actualizar el tipo de elemento para controlar esto en la parte del frontend.
        ====================================================================================
    */

    public $tipoElemento = 1; // 1 para proyectos, 2 para planos, 3 para videos.

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
            $this->tipoElemento = $tipo;
        }
        else if ( $tipo == 2 )
        {
            $this->mostrarProyect = "d-none";
            $this->mostrarPlanos = "d-block";
            $this->mostrarVideos = "d-none";
            $this->tipoElemento = $tipo;
        }
        else
        {
            $this->mostrarProyect = "d-none";
            $this->mostrarPlanos = "d-none";
            $this->mostrarVideos = "d-block";
            $this->tipoElemento = $tipo;
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
            ( $this->tipoElemento === 1 && $this->posicion < count($this->recursosPropiedad["images"]) )
            ||
            ( $this->tipoElemento === 2 && $this->posicion < count($this->recursosPropiedad["planos"]) )
            ||
            ($this->tipoElemento === 3 && $this->posicion < count($this->recursosPropiedad["videos"]) )
        )
        {
            $this->posicion++;
        }

        /*
        * Esto de aqui nos ayudara mucho para que se siga mostrando la parte de este carrusel de varios opciones.
        */
        $this->mostrar = "d-block";
    }

    public function cerrarCarrusel()
    {
        $this->mostrar = "d-none";
        $this->posicion = 0;
        $this->tipoElemento = 1;

        $this->mostrarProyect = "d-block";
        $this->mostrarPlanos = "d-none";
        $this->mostrarVideos = "d-none";
    }
}
