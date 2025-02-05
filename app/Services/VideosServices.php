<?php

namespace App\Services;

use App\Models\Video;
use Illuminate\Support\Facades\Http;

class VideosServices
{
    private $token;
    private $url;

    public function __construct(
        $token,
        $url
    ) {
        $this->token = $token;
        $this->url = $url;
    }

    public function registrarVideo( $codigos, $idPropiedad )    {

        $status = "SIN REGISTRAR VIDEOS";

        try {
            //code...
            $respuestaVideos = Http::post($this->url."cargar", [
                "route" => $codigos,
                "propertyId" => $idPropiedad,
                "token" => $this->token
            ]);

            if ( $respuestaVideos->successful() )
            {
                $status = "REGISTRADO VIDEOS";
            }

            return $status;

        } catch (\Throwable $th) {

           return $status;
        }
    }

    public function editarVideo( $codigos, $idPropiedad )
    {
        $status = "SIN EDITAR VIDEOS";

        $respuestaVideos = Http::post($this->url . "actualizar", [
            "propertyId" => $idPropiedad,
            "route" => $codigos,
            "token" => $this->token
        ]);

        if ( $respuestaVideos->successful() )
        {
            $status = "EDITADO VIDEOS";
        }

        return $status;
    }
}
?>
