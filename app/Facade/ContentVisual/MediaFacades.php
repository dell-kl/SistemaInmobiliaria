<?php

namespace App\Facade\ContentVisual;

use App\Services\VideosServices;

class MediaFacades {


    private VideosServices $_videosServicio;

    public function __construct(
        VideosServices $videosServicio
    )
    {
        $this->_videosServicio = $videosServicio;
    }

    public function registerMedia($videos, $idPropiedad)
    {
        $codigos = explode(",", $videos);

        return $this->_videosServicio->registrarVideo($codigos, $idPropiedad);
    }

    public function editMedia($videos, $idPropiedad)
    {
        if ( strlen($videos) == 1 ) $codigos = explode(" ", $videos);

        else if ( strlen($videos) == 0 ) $codigos = [];

        else $codigos = explode(",", $videos);

        return $this->_videosServicio->editarVideo($codigos, $idPropiedad);
    }
}
?>
