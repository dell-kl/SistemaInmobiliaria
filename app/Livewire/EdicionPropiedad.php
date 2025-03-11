<?php
namespace App\Livewire;

use App\Services\ImagenesServices;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
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

    /**
     * Este evento de aqui esta ligado con la parte del carrusel de imagenes ... del cual tiene unas opciones,
     * que son 'eliminar' y 'editar' las imagenes respectivas de la propiedad...
     */
    #[On('actualizar-imagenes-propiedad')]
    public function actualizarImagenesPropiedad(ImagenesServices $imagenes, $valor)
    {
        $url = config('app.url_api') . "/api/imagenes/solicitar";

        if ( !empty($valor) )
        {
            $tipo = $valor["tipo"];

            $respuesta = Http::post($url, [
                "idPropiedad" => 1,
                "tipo" => $tipo,
                "token" => $this->token
            ]);
        }
    }

}


