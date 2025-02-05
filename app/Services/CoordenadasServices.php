<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class CoordenadasServices
{
    private $token;
    private $url;

    public function __construct($token, $url)
    {
        $this->token = $token;
        $this->url = $url;
    }

    public function registrarCoordenadas($idPropiedad, $coordenadas) {

        $status = "SIN REGISTRAR COORDENADAS";

        $respuestaCoordenadas = Http::post($this->url . "registrar", [
            "coodenadas" => $coordenadas,
            "propertyId" => $idPropiedad,
            "token" => $this->token
        ]);

        if ( $respuestaCoordenadas->successful() )
        {
            $status = "REGISTRADO COORDENADAS";
        }

        return $status;
    }

    public function editarCoordenadas($idPropiedad, $coordenadas)
    {
        $status = "SIN EDITAR COORDENADAS";

        $respuestaCoordenadas = Http::post($this->url . "actualizar", [
            "propertyId" => $idPropiedad,
            "coodenadas" => $coordenadas,
            "token" => $this->token
        ]);

        if ( $respuestaCoordenadas->successful() )
        {
            $status = "EDITADO COORDENADAS";
        }

        return $status;
    }
}
?>
