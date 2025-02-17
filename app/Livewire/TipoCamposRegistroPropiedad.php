<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Attributes\On;

class TipoCamposRegistroPropiedad extends Component
{
    public $typeProjects = 1;
    public $datosPropiedad;

    /**
     * Propiedades adicionales para generar la validacion.
     */

    public $habitaciones;
    public $banos;
    public $estacionamiento;

    // validaciones para la parte de las medidas del proyecto.
    public $area;
    public $altoProfundidad;

    //vamos a validar la parte de la disponibilidad de nuestro campo.
    public $disponibilidadProyecto;

    public $precioProyecto;

    public $descripcionProyecto;

    public $codigosVideoYoutube;

    protected $rules = [
        'area' => 'required',
        'altoProfundidad' => 'required',
        'disponibilidadProyecto' => 'required',
        'precioProyecto' => 'required|numeric|min:100',
        'descripcionProyecto' => 'required|max:150',
        'codigosVideoYoutube' => ['required', 'regex:/^([a-zA-Z0-9_-]{11})(,[a-zA-Z0-9_-]{11})*$/']
    ];

    public function render()
    {
        $this->llenarInformacion();

        return view('livewire.tipo-campos-registro-propiedad');
    }

    private function llenarInformacion()
    {
        //con esto vamos a llenar la informacion de cada campo para la parte de editar.
        if ( isset($this->datosPropiedad)
        && !isset($this->habitaciones)
        && !isset($this->banos)
        && !isset($this->estacionamiento)
        && !isset($this->area)
        && !isset($this->altoProfundidad)
        && !isset($this->disponibilidadProyecto)
        && !isset($this->precioProyecto)
        && !isset($this->descripcionProyecto))
        {
            //vamos a establcer los valores.
            $this->habitaciones = $this->datosPropiedad["properties_rooms"];
            $this->banos = $this->datosPropiedad["properties_bathrooms"];
            $this->estacionamiento = $this->datosPropiedad["properties_parking"];
            $this->area = $this->datosPropiedad["properties_area"];
            $this->altoProfundidad = $this->datosPropiedad["properties_height"];
            $this->disponibilidadProyecto = $this->datosPropiedad["properties_availability"];
            $this->precioProyecto = $this->datosPropiedad["properties_price"];
            $this->descripcionProyecto = $this->datosPropiedad["properties_description"];


            //setear diferente manera la parte de nuestro videos.
            $videos = $this->datosPropiedad["videos"];

            $codigos = "";
            foreach ($videos as $key=>$video)
            {
                if ( count($videos)-1 == $key ) $codigos .= $video["videos_route"];
                else $codigos .= $video["videos_route"] . ",";
            }
            $this->codigosVideoYoutube = $codigos;

        }
    }

    protected function messages()
    {
        return [
            'habitaciones.required' => 'Campo requerido y numerico',
            'habitaciones.numeric' => 'Debe ser un numero',
            'habitaciones.min' => 'Desde una habitacion para adelante',
            'habitaciones.max' => 'Maximo 5 habitaciones',

            'banos.required' => 'Se acepta hasta 4 baños y la expresion "baño y medio"',
            'banos.regex' => 'Se acepta hasta 4 baños y la expresion "baño y medio"',

            'estacionamiento.required' => 'Campo requerido y numerico',
            'estacionamiento.numeric' => 'Debe ser un numero',
            'estacionamiento.min' => 'Desde un estacionamiento para adelante',
            'estacionamiento.max' => 'Maximo 4 estacionamientos',

            'area.required' => 'Campo requerido',
            'altoProfundidad.required' => 'Campo requerido',
            'disponibilidadProyecto.required' => 'Debes escoger una disponibilidad del proyecto',


            'precioProyecto.required' => 'Campo requerido y numerico',
            'precioProyecto.numeric' => 'Debe ser un numero',
            'precioProyecto.min' => 'Ingresa un precio mayor o igual a 100',

            'descripcionProyecto.required' => 'Campo requerido',
            'descripcionProyecto.max' => 'Maximo 150 caracteres',

            'codigosVideoYoutube.required' => 'Campo requerido',
            'codigosVideoYoutube.regex' => 'Introduce codigo de youtube valido, si es mas de uno separalo por comas.'
        ];
    }


    public function actualizarValidaciones()
    {
        if ( $this->typeProjects == 1 || $this->typeProjects == 2 ) {

            $this->rules["habitaciones"] = 'required|numeric|min:1|max:5';
            $this->rules["banos"] = ['required', 'regex:/^[0-4]$|^baño y medio$/i'];

            if ( $this->typeProjects == 1 ) {
                $this->rules["estacionamiento"] = 'required|numeric|min:1|max:4';
            }

        }

        try {
            if ( $this->typeProjects == 1 || $this->typeProjects == 2 ) $this->validateOnly('habitaciones');
            if ( $this->typeProjects == 1 || $this->typeProjects == 2 ) $this->validateOnly('banos');
            if ( $this->typeProjects == 1 ) $this->validateOnly('estacionamiento');

            $this->validateOnly('area');
            $this->validateOnly('altoProfundidad');
            $this->validateOnly('disponibilidadProyecto');
            $this->validateOnly('precioProyecto');
            $this->validateOnly('descripcionProyecto');
            $this->validateOnly('codigosVideoYoutube');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            $this->actualizarFormulario(false);
        }

        $resultado = $this->validate();

        if ( !empty($resultado) )
        {
            $this->actualizarFormulario(true);
        }

    }

    public function EventUpdateTypeProject($type)
    {
        $typeProjects = intval( $type );
    }

    public function actualizarFormulario($valor)
    {
        $this
            ->dispatch('formulario-registro', ['tipo' => 'datosProyecto', 'valor' => $valor] )
            ->to(RegistroPropiedad::class);
    }

    #[On('desactivar-formulario')]
    public function desactivarFormulario()
    {
        $this->actualizarFormulario(false);
    }
}
