<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PlansServices {

    protected $token;
    protected $url;

    public function __construct($token, $url)
    {
        $this->token = $token;
        $this->url = $url;
    }

    public function registrarPlan($planos, $idPropiedad)
    {
        $intentos = 5;

        $status = "SIN REGISTRAR PLANOS";

        while( $intentos > 0 )
        {
            try {
                //code...
                $respuestaPlanos = $planos->post($this->url. 'cargar', [
                    'PropertyId' => $idPropiedad,
                    "token" => $this->token
                ]);

                if ( $respuestaPlanos->successful() )
                {
                    $status = "REGISTRADO PLANOS";
                    break;
                }

                $intentos--;
            } catch (\Throwable $th) {
                $intentos+=1;
            }
        }

        return $status;
    }
}
?>
