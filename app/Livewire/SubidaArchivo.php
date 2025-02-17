<?php
namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class SubidaArchivo extends Component
{
    use WithFileUploads;

    public $respuestaValidacion;
    public $identificador;
    public $tipoSubidaArchivo;
    public $widthProperty;
    public $heightProperty;
    public $mensaje;
    public $subtitulo;

    public $mostrarBotonValidar = false;

    /**
     * ====================================
     * VARIABLES PARA MOSTRAR LOADING O SUBIDA DE ARCHIVOS
     * ====================================
     */
    public $mostrarSubidaArchivos = true;
    public $mostrarCarga = false;


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

    public function render()
    {
        return view('livewire.subida-archivo');
    }

    public function activarEntrada()
    {
        //vamos a tener que realizar desde este punto una activacion hacia nuestro DOM.
        $this->dispatch("activarEntrada");
    }

    /**
     * Metodo para poder actualizar el respectivo registro de propiedad.
     */
    public function actualizarFormulario($valor)
    {
        $payload = ['tipo' => 'imgProyecto', 'valor' => $valor];

        if ( $this->tipoSubidaArchivo != 'imagenes' )
        {
            $payload['tipo'] = 'imgPlanos';
        }

        $this
            ->dispatch('formulario-registro', $payload )
            ->to(RegistroPropiedad::class);
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
