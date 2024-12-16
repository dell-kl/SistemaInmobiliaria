<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Network\Address;
use App\Tools\RequestTool;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GestionPropiedadController
{
    private string $ruta;

    public function __construct() {
        $this->ruta = config("app.url_api");
    }

    public function propiedad() : View
    {
        try {
            //code...
            $this->ruta = $this->ruta . "/api/propiedades/listar";
            $respuesta = Http::get($this->ruta);

            $propiedades = array();

            if ( $respuesta->successful() )
            {
                $propiedades = $respuesta->json();
            }

            return view('moduloGestionPropiedad.propiedad', ['propiedades' => $propiedades]);
        } catch (\Throwable $th) {
            //throw $th;
            dd("Error ..." . $th->getMessage());
        }
    }

    /**
     * Este metodo de aqui lo vamos a relacionar con nuestro formulario de registro de propiedad.
     */
    public function registrarPropiedad(Request $request)
    {
        try
        {
            $datos = $request->all();

            /**
             * ==============================================================
             * Registro Propiedad
             * ==============================================================
             */

            if ( $datos["tipoProyecto"] != 1 )
                $datos["numeroEstacionamiento"] = 0;

            //definimos la ruta de la api que guarda las propiedades. y le pasamos su contenido json de la propiedad.
            $respuesta = Http::post($this->ruta . "/api/propiedades/registrar", [
                "properties_rooms" => $datos["numeroHabitaciones"],
                "properties_bathrooms" => $datos["numeroBanios"],
                "properties_parking" =>  $datos["numeroEstacionamiento"] ,
                "properties_price" => $datos["PrecioProyecto"],
                "properties_availability" => $datos["EstadoProyecto"],
                "properties_height" => $datos["tipoProyecto"] != 3 ? $datos["AltoProyecto"] : $datos["ProfundidadProyecto"],
                "properties_area" => $datos["AreaProyecto"],
                "properties_description" => $datos["DescripcionProyecto"],
                "properties_state" => 1,
                "properties_address" => $datos["DireccionProyecto"],
                "Properties_typePropertieId" => $datos["tipoProyecto"],
                "Properties_parroquiasId" => $datos["ParroquiaProyecto"]
            ]);

            if ( $respuesta->successful() )
            {
                //registramos ahora las imagenes...
                $propiedad = Http::get($this->ruta . "/api/propiedades/ultimo")->json();

                $respuestaImagen = Http::attach('FileIMG[0]', fopen($datos["entrada_imagenes"][0]->getPathname(), 'r'), $datos["entrada_imagenes"][0]->getClientOriginalName(), [
                    'Content-Type' => $datos["entrada_imagenes"][0]->getMimeType()
                ]);

                //interamos las demas imagenes restantes.
                foreach ($datos["entrada_imagenes"] as $index => $file) {
                    if ( $index > 0 )
                    {
                        $respuestaImagen->attach("FileIMG[$index]", fopen($file->getPathname(), 'r'), $file->getClientOriginalName(), [
                            'Content-Type' => $file->getMimeType()
                        ]);
                    }
                }

                $respuestaImagen = $respuestaImagen->post($this->ruta . '/api/imagenes/cargar', [
                        'PropertyId' => $propiedad['mensaje']['properties_id']
                    ]);


                //registraremos los planos respectivo ...

                $respuestaPlanos = Http::attach('PlanIMG[0]', fopen($datos["entrada_planos"][0]->getPathname(), 'r'), $datos["entrada_planos"][0]->getClientOriginalName(), [
                    'Content-Type' => $datos["entrada_planos"][0]->getMimeType()
                ]);

                foreach ($datos["entrada_planos"] as $index => $file )
                {
                    if ( $index > 0 )
                    {
                        $respuestaPlanos->attach("PlanIMG[$index]", fopen($file->getPathname(), 'r'), $file->getClientOriginalName(), [
                            'Content-Type' => $file->getMimeType()
                        ]);
                    }
                }

                $respuestaPlanos = $respuestaPlanos->post($this->ruta . '/api/planos/cargar', [
                    'PropertyId' => $propiedad['mensaje']['properties_id']
                ]);


                // //registraremos los codigos respectivos del proyecto.
                $codigos = explode(",", $datos["VideosProyecto"]);

                $respuestaVideos = Http::post($this->ruta . "/api/videos/cargar", [
                    "route" => $codigos,
                    "propertyId" => $propiedad["mensaje"]["properties_id"]
                ]);

                if (
                    $respuestaImagen->successful() &&
                    $respuestaPlanos->successful() &&
                    $respuestaVideos->successful()
                )
                {
                    dd("correcto...");
                }

                // dd("error guardar datos extras...");
            }

            dd("error ... ");
        }
        catch(\Exception $exception)
        {
            dd("Error ..." . $exception->getMessage() . " " . $exception->getCode());
        }
    }

}
