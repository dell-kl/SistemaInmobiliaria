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

    public $imagenes = [];

    protected $rules = [
        'imagenes' => 'array|max:5',
        'imagenes.*' => 'required|image|mimes:jpg,jpeg,png|max:1024',
    ];

    protected $messages = [
        'imagenes.required' => 'Es un requisito realizar la subida de las imagenes para el proyecto',
        'imagenes.max' => 'Actualmente no se permiten imagenes mayores a 1GB',
        'imagenes.array' => 'Solamente es permitido subir 5 imagenes',
        'imagenes.*.mimes' => 'Solo se permiten imagenes de tipo jpg, jpeg o png',
        // 'imagenes.*.max' => 'Las imagenes no pueden pesar mas de 1GB'
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
        $this->validateOnly('imagenes');
    }

    public function borrarImagen($rutaTemp)
    {
        /**
         * Con array_filter lo que hagao es encontrar cual imagen de la lista tiene el valor de $rutaTemp
         * quien lo tiene me saco su indice para eliminarlo en su lista original osea $this->imagenes...
         *
         * la expresion : use ($rutaTemp) <- uso para acceder a una variable global que esta fuera del entorno
         * local de mi array_filter
         *
         * array_splice() <- realiza la eliminacion de mi elemento que logre sacarme su posicion en mi lista original.
         */


        $resultado = array_filter($this->imagenes, function($imagen) use ($rutaTemp){

            if ( $imagen->getFilename() == $rutaTemp )
            {
                return $imagen;
            }
        });

        array_splice($this->imagenes, array_keys($resultado)[0], 1);
    }
}
