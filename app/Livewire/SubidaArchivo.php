<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubidaArchivo extends Component
{
    use WithFileUploads;

    public $identificador;
    public $tipoSubidaArchivo;
    public $widthProperty;
    public $heightProperty;
    public $mensaje;
    public $subtitulo;


    public $mostrarBotonValidar = false;

    /**
     * ====================================
     * DEFINICION DE LA IMAGEN A ELIMINAR
     * ====================================
     */

     public $imagenEliminar;

    /**
     * ====================================
     * DEFINICION DE NUESTRO ATRIBUTO
     * ====================================
     */

    #[Validate('required|image|mimes:jpg,jpeg,png|max:2024')]
    public $imagenes = [];

    protected $messages = [
        'imagenes.required' => 'Es un requisito realizar la subida de las imagenes para el proyecto',
        'imagenes.image' => 'Agrega solamente imagenes en este apartado.',
        'imagenes.max' => 'Actualmente no se permiten imagenes mayores a 2GB',
    ];


    public function render()
    {
        if ( !empty($this->imagenes) ) {
            $this->mostrarBotonValidar = true;
        }

        return view('livewire.subida-archivo');
    }

    public function activarEntrada()
    {
        //vamos a tener que realizar desde este punto una activacion hacia nuestro DOM.
        $this->dispatch("activarEntrada");
    }

    public function validarImagenes()
    {
        //vamos a realizar unas cuantas validaciones para la parte de nuestras imagenes.
        $this->validate();
    }

    public function borrarImagen($imagenes)
    {
        //vamos a filtrar nuestra list de imagenes para eliminar la que se desea.
        dd($imagenes);
    }
}
