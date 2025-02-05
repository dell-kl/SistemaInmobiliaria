<?php

namespace App\Facade\ContentVisual;

use App\Services\ImagenesServices;
use Illuminate\Support\Facades\Http;

class ImagesFacades {

    private ImagenesServices $imagenesServices;

    public function __construct(ImagenesServices $imagenesServices)
    {
        $this->imagenesServices = $imagenesServices;
    }

    public function registerImages($imagenes, $idPropiedad)
    {
        $respuestaImagen = Http::attach(
            'FileIMG[0]',
            fopen($imagenes[0]->getPathname(), 'r'),
            $imagenes[0]->getClientOriginalName(),
            [
            'Content-Type' => $imagenes[0]->getMimeType()
        ]);

        //interamos las demas imagenes restantes.
        foreach ($imagenes as $index => $file) {
            if ($index > 0)
            {
                $respuestaImagen->attach(
                    "FileIMG[$index]",
                    fopen($file->getPathname(), 'r'),
                    $file->getClientOriginalName(),
                    [ 'Content-Type' => $file->getMimeType() ]
                );
            }
        }

        return $this->imagenesServices->registrarImagen($respuestaImagen, $idPropiedad);
    }

}
?>
