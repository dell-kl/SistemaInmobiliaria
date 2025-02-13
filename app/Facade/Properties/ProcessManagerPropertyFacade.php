<?php

namespace App\Facade\Properties;

use App\Facade\ContentVisual\CoordinatesFacades;
use App\Facade\ContentVisual\ImagesFacades;
use App\Facade\ContentVisual\MediaFacades;
use App\Facade\ContentVisual\PlansFacades;

class ProcessManagerPropertyFacade {

    //este de aqui nos servira para llamar
    //algunas cuantos otros servicios que
    //tenemos por detras....
    //estos servicio slos tendremos que inyectar
    private ProcessPropertyFacade $_propiedad;
    private ImagesFacades $_imagenes;

    private PlansFacades $_plans;
    private MediaFacades $_videos;
    private CoordinatesFacades $_coordinates;

    public function __construct(
        ProcessPropertyFacade $propiedad,
        ImagesFacades $imagenes,
        PlansFacades $plans,
        MediaFacades $videos,
        CoordinatesFacades $coordinates
    )
    {
        $this->_propiedad = $propiedad;
        $this->_imagenes = $imagenes;
        $this->_plans = $plans;
        $this->_videos = $videos;
        $this->_coordinates = $coordinates;
    }

    /**
     * Este metodo de aqui es lo que vera
     * el cliente para que no tenga que
     * estar viendo la parte de los servicios
     * o que ocurre internamente.
     */
    public function procesoRegistrar($datos) {
        
       $StatusPropiedad = $this->_propiedad->registrarPropiedad($datos);

       if ( $StatusPropiedad !== "INAUTORIZADO" && $StatusPropiedad !== "SIN REGISTRAR" )
       {
            $idPropiedad = $StatusPropiedad["mensaje"]["properties_id"];

           //continuamos con la parte de las imagenes... de registrarlas.
            $StatusPropiedad = $this->_imagenes->registerImages(
                $datos["entrada_imagenes"],
                $idPropiedad
            );

            if ( $StatusPropiedad == "REGISTRADO IMAGENES" )
            {
                //continuamso con la parte de registrar los planos.
                $StatusPropiedad = $this->_plans->registerPlans(
                    $datos["entrada_planos"],
                    $idPropiedad
                );

                if ( $StatusPropiedad == "REGISTRADO PLANOS" )
                {
                    //continuamos con la parte del registro de los videos.
                    $StatusPropiedad = $this->_videos->registerMedia(
                        $datos["VideosProyecto"],
                        $idPropiedad
                    );

                    if ( $StatusPropiedad == "REGISTRADO VIDEOS" )
                    {
                        //continuamos con la parte del registro de las coordenadas.
                        $StatusPropiedad = $this->_coordinates->registerCoordinates(
                            $idPropiedad,
                            $datos["ubicacionMapa"]
                        );

                        if ( $StatusPropiedad == "REGISTRADO COORDENADAS" )
                        {
                            return "REGISTRADO PROPIEDAD";
                        }
                    }
                }
            }
       }

       return $StatusPropiedad;
    }


    /**
     *mmm esta parte de aqui se parecera un tanto con la parte de registrar...
     * habra cosas que se repitan y otras que no.
     *
     * LA parte de las imagenes no se van a registrar dentro de este proceso porque tiene otro
     * tipo de funcionalidad para poder hacer su cambio... aqui solo se modificar la parte
     * que no es tan complicada de procesar en su actualizacion.
     *
     */
    public function procesoEditar($datos)
    {
        $StatusPropiedad = $this->_propiedad->editarPropiedad($datos);

        if ( $StatusPropiedad !== "INAUTORIZADO" && $StatusPropiedad !== "SIN ACTUALIZAR" )
        {
            $idPropiedad = $datos["propiedadId"];

            //vamos actualizar la parte de las coordenadas.
            $StatusPropiedad = $this->_coordinates->editCoordinates(
                $idPropiedad,
                $datos["ubicacionMapa"]
            );

            if ( $StatusPropiedad == "EDITADO COORDENADAS" )
            {

                //actualizar la parte de los videos que se cargan.
                $StatusPropiedad = $this->_videos->editMedia(
                    $datos["VideosProyecto"],
                    $idPropiedad);

                if ( $StatusPropiedad == "EDITADO VIDEOS" )
                {
                    return "EDITADO PROPIEDAD";
                }

            }

        }

        return $StatusPropiedad;
    }

    public function procesoEliminar($id)
    {
        return $this->_propiedad->eliminarPropiedad($id);
    }
}
?>
