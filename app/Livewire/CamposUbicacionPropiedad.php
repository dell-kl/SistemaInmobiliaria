<?php

namespace App\Livewire;

use App\Models\Canton;
use App\Models\Parroquia;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class CamposUbicacionPropiedad extends Component
{
    public array $Listadocantones;
    public array $ListadoParroquias;
    public $idCanton;
    public bool $mostrarMapa = false;

    //estas propiedades de aqui son usados mucho para la parte de la edicion de nuestra propiedad.
    public $datosPropiedad;
    public $idParroquia;

    public $direccionPropiedad;

    //seccion para la parte de la validacion de los campos.
    protected $rules = [
        'idCanton' => 'required|min:1|regex:/^[1-9]+$/',
        'idParroquia' => 'required|min:1',
        'direccionPropiedad' => 'required',
    ];

    protected function messages()
    {
        //mensajes personalizados del cual vamos agreegar para cada uno de nuestros campos.
        return [
            'idCanton.required' => 'El canton es obligatorio',
            'idCanton.min' => 'El canton es obligatorio',
            'idCanton.regex' => 'El canton es obligatorio',
            'idParroquia.required' => 'La parroquia es obligatorio',
            'idParroquia.min' => 'La parroquia es obligatorio',
            'direccionPropiedad.required' => 'La direccion es obligatoria para el proyecto',
        ];
    }


    public function render() : View
    {
        $rutaApi = config('app.url_api') . '/api/ubicacion/listado';

        //consumo de nuestro api para poder presentar los respectvos datos en el frontend.. principalemnte en los campos de select.
        $response = Http::get($rutaApi);

        //pasar la infromacion de todos los cantones.
        $Listadocantones = $response->json();

        $resultado = [];

        if ( isset($this->idCanton) && $this->idCanton != 0 ) {
            $resultado = collect($Listadocantones)->where('cantons_id', $this->idCanton)->first();
            $resultado = $resultado['obtener_parroquias'];
        }

        return view('livewire.campos-ubicacion-propiedad')->with([
            'cantones' => $Listadocantones,
            'parroquias' => $resultado
        ]);
    }

    private function rellenarDatos()
    {

    }

    public function validacionCampos()
    {
        try {
            //code...
            $this->validateOnly('idCanton');
            $this->validateOnly('idParroquia');
            $this->validateOnly('direccionPropiedad');
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

    public function actualizarFormulario($valor)
    {
        $this
            ->dispatch('formulario-registro', ['tipo' => 'datosUbicacion', 'valor' => $valor] )
            ->to(RegistroPropiedad::class);
    }


    //esta opcion de aqui se va a ejecutar cuando seleccionemos un canto disponible.
    public function cantonOpcion() : void
    {
        $canton = Canton::Where('cantons_id', $this->idCanton)->first();
        $ListadoParroquias = $canton->obtenerParroquias();
    }

    #[On('post-created')]
    public function mostrarMapa() : void
    {
        //<button type="button" @click="$dispatch('post-created')" class="btn btn-warning ms-2">Carga Mapa </button>

        $this->mostrarMapa = !$this->mostrarMapa;
    }
}
