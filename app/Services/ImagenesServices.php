<?php

namespace App\Services;

class ImagenesServices {

    private $token;
    private $url;

    public function __construct(
        $token, $url
    ) {
        $this->token = $token;
        $this->url = $url;
    }

    public function registrarImagen($imagenes, $idPropiedad)  {

        //code...
        $intentos = 3;

        //nuestro proceso para guardar las imagenes va a tener un numero de 3 intentos para realizarlo.
        $status = "SIN REGISTRAR IMAGENES";

        while( $intentos > 0 )
        {
            try {
                //code...
                $respuestaImagen = $imagenes->post($this->url.'cargar', [
                    'PropertyId' => $idPropiedad,
                    "token" => $this->token
                ]);

                if ( $respuestaImagen->successful() )
                {
                    $status = "REGISTRADO IMAGENES";
                    break;
                }

                $intentos--;
            } catch (\Throwable $th) {
                //throw $th;
                $intentos += 1;
            }
        }

        return $status;
    }

    public function solicitarImagen(array $valor) {

    }
}
?>
