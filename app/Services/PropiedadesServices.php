<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Http;

class PropiedadesServices {

    private $token;
    private $url;

    public function __construct(
        $token, $url
    ) {
        $this->token = $token;
        $this->url = $url;
    }

    public function eliminarPropiedad($idPropiedad)
    {
        $status = "PROPIEDAD SIN ELIMINAR";

        $respuesta = Http::delete($this->url . "eliminar", [
            "propiedadId" => $idPropiedad,
            "token" => $this->token
        ]);

        if ( $respuesta->successful() )
        {
            $status = "PROPIEDAD ELIMINADA";
        }

        return $status;
    }

    public function editarPropiedad($payload)
    {

        $payload["token"] = $this->token;

        $response = Http::post($this->url . 'actualizar', $payload);

        $body = json_decode($response->body(), true);

        if ( $body["mensaje"] == "Inautorizado" )
        {
            return "INAUTORIZADO";
        }

        if ( $response->successful() )
        {
            return "ACTUALIZADO";
        }

        return "SIN ACTUALIZAR";
    }

    public function registrarPropiedad($payload)
    {
        //aqui vamos a tener que consumir la parte de nuestro
        //api rest para mandar a guardar nuestra propiedad.
        $payload["token"] = $this->token;

        //vamos a llamar a llamar a nuestro api rest para guardar los respectivos datos.
        $response = Http::post($this->url . 'registrar', $payload);

        //sacamos la informacion que me arroja el respecitvo api.
        $body = json_decode($response->body(), true);

        if ( $body["mensaje"] == "Inautorizado" )
        {
            return "INAUTORIZADO";
        }

        if ( $response->successful() )
        {
            //vamos a devolver la informacion de la propiedad que registramos... osea el ultmo registro.
            $propiedad = Http::get($this->url . 'ultimo');

            return $propiedad->json();
        }

        return "SIN REGISTRAR";
    }
}

?>
