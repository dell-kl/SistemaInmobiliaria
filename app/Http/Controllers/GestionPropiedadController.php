<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Property;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use RealRashid\SweetAlert\Facades\Alert;

class GestionPropiedadController extends Controller
{
    private string $ruta;
    private int $idUsuario;

    public function __construct() {
        $this->ruta = config("app.url_api");
        $this->idUsuario = JWTAuth::parseToken()->getPayload()->get('id');
    }

    public function propiedad(Request $request) : View
    {
        try {
            dd($request);
            //code...
            $this->ruta = $this->ruta . "/api/propiedades/listar";

            $respuesta = Http::get($this->ruta);

            $propiedades = array();

            if ($respuesta->successful()) {
                $propiedades = $respuesta->json();
            }

            //informacion de la persona que se autentico.
            $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');

            return view('moduloGestionPropiedad.propiedad', [
                'propiedades' => $propiedades,
                'rolUsuario' => $rolUsuario

            ]);
        } catch (\Throwable $th) {
            dd("Error ..." . $th->getMessage());
        }
    }


    //actualizacion de nuestra propiedad.
    public function actualizarPropiedad(Request $request)
    {
        try {
            //tomamos los datos y los comparamos con nuestra propiedad que vamos a querer actualizar.
            $datos = $request->all();

            $tokenAcceso = explode(" ", $request->headers->get("Authorization"))[1];

            if ( $datos["tipoProyecto"] != 1 )
            {
                $datos["numeroEstacionamiento"] = 0;
            }

            $respuesta = Http::post($this->ruta . "/api/propiedades/actualizar", [
                "properties_id" => $datos["propiedadId"],
                "properties_rooms" => $datos["tipoProyecto"] == 3 ? 0 :  $datos["numeroHabitaciones"],
                "properties_bathrooms" => $datos["tipoProyecto"] == 3 ? 0 : $datos["numeroBanios"],
                "properties_parking" => $datos["tipoProyecto"] == 3 ? 0 :  $datos["numeroEstacionamiento"] ,
                "properties_price" => $datos["PrecioProyecto"],
                "properties_availability" => $datos["EstadoProyecto"],
                "properties_height" => $datos["tipoProyecto"] != 3 ? $datos["AltoProyecto"] : $datos["ProfundidadProyecto"],
                "properties_area" => $datos["AreaProyecto"],
                "properties_description" => $datos["DescripcionProyecto"],
                "properties_state" => 1,
                "properties_address" => $datos["DireccionProyecto"],
                "Properties_typePropertieId" => $datos["tipoProyecto"],
                "Properties_parroquiasId" => $datos["ParroquiaProyecto"],
                "token" => $tokenAcceso
            ]);

            $body = json_decode($respuesta->body(), true);

            if ( $body["mensaje"] == "Inautorizado" )
            {
                Alert::error('Inautorizado', 'No puedes acceder al api de propiedades, por falta de autenticacion.')
                ->autoclose(5000);
                return redirect('/propiedades');
            }

            if ( $respuesta->successful() )
            {

                //vamos a realizar la actualizacion de otras propiedades adicionales de nuestro proyecto.

                /**
                 * ===========================================================
                 * ACTUALIZAR COORDENADAS
                 * ===========================================================
                 */
                $respuestaCoordenadas = Http::post($this->ruta . "/api/coordenadas/actualizar", [
                    "propertyId" => $datos["propiedadId"],
                    "coodenadas" => $datos["ubicacionMapa"],
                    "token" => $tokenAcceso
                ]);

                if ( !$respuestaCoordenadas->successful() )
                {
                    Alert::error('Actualizacion Coordenadas Propiedad', $body["mensaje"])
                    ->autoclose(5000);
                    return redirect('/propiedades');
                }

                /**
                 * ===========================================================
                 * ACTUALIZAR VIDEO
                 * ===========================================================
                 */

                if ( strlen($datos["VideosProyecto"]) == 1 )
                {
                    $codigos = explode(" ", $datos["VideosProyecto"]);
                }
                else if ( strlen($datos["VideosProyecto"]) == 0 )
                {
                    $codigos = [];
                }
                else
                {
                    $codigos = explode(",", $datos["VideosProyecto"]);
                }

                $respuestaVideos = Http::post($this->ruta . "/api/videos/actualizar", [
                    "propertyId" => $datos["propiedadId"],
                    "route" => $codigos,
                    "token" => $tokenAcceso
                ]);

                if ( !$respuestaVideos->successful() )
                {
                    Alert::error('Actualizacion Videos Propiedad', $body["mensaje"])
                    ->autoclose(5000);
                    return redirect('/propiedades');
                }

                Alert::success('Actualizacion Propiedad', $body["mensaje"])
                ->autoclose(5000);
                return redirect('/propiedades');
            }

            Alert::error('Alteracion Propiedad', $body["mensaje"])
            ->autoclose(5000);
            return redirect('/propiedades');
        } catch (\Throwable $th) {

            //throw $th;
            Alert::error('Alteracion Propiedad', 'Error de servidor, intentalo de nuevo mas tarde')
            ->autoclose(5000);
            return redirect('/propiedades');
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

            if ($datos["tipoProyecto"] != 1)
                $datos["numeroEstacionamiento"] = 0;

            $tokenAcceso = explode(" ", $request->headers->get("Authorization"))[1];

            //definimos la ruta de la api que guarda las propiedades. y le pasamos su contenido json de la propiedad.
            $respuesta = Http::post($this->ruta . "/api/propiedades/registrar", [
                "properties_rooms" => $datos["tipoProyecto"] == 3 ? 0 :  $datos["numeroHabitaciones"],
                "properties_bathrooms" => $datos["tipoProyecto"] == 3 ? 0 : $datos["numeroBanios"],
                "properties_parking" => $datos["tipoProyecto"] == 3 ? 0 :  $datos["numeroEstacionamiento"] ,
                "properties_price" => $datos["PrecioProyecto"],
                "properties_availability" => $datos["EstadoProyecto"],
                "properties_height" => $datos["tipoProyecto"] != 3 ? $datos["AltoProyecto"] : $datos["ProfundidadProyecto"],
                "properties_area" => $datos["AreaProyecto"],
                "properties_description" => $datos["DescripcionProyecto"],
                "properties_state" => 1,
                "properties_address" => $datos["DireccionProyecto"],
                "Properties_typePropertieId" => $datos["tipoProyecto"],
                "Properties_parroquiasId" => $datos["ParroquiaProyecto"],
                "token" => $tokenAcceso
            ]);


            $body = json_decode($respuesta->body(), true);

            if ( $body["mensaje"] == "Inautorizado" )
            {
                Alert::error('Inautorizado', 'No puedes acceder al api de propiedades, por falta de autenticacion.')
                ->autoclose(5000);
                return redirect('/propiedades');
            }

            if ( $respuesta->successful() )

            {
                // registramos ahora las imagenes...
                $propiedad = Http::get($this->ruta . "/api/propiedades/ultimo")->json();

                /*
                ===============================================================
                Registro Imagenes
                ==============================================================*/

                $respuestaImagen = Http::attach('FileIMG[0]', fopen($datos["entrada_imagenes"][0]->getPathname(), 'r'), $datos["entrada_imagenes"][0]->getClientOriginalName(), [
                    'Content-Type' => $datos["entrada_imagenes"][0]->getMimeType()
                ]);

                //interamos las demas imagenes restantes.
                foreach ($datos["entrada_imagenes"] as $index => $file) {
                    if ($index > 0)
                    {
                        $respuestaImagen->attach("FileIMG[$index]", fopen($file->getPathname(), 'r'), $file->getClientOriginalName(), [
                            'Content-Type' => $file->getMimeType()
                        ]);
                    }
                }

                $respuestaImagen = $respuestaImagen->post($this->ruta . '/api/imagenes/cargar', [
                        'PropertyId' => $propiedad['mensaje']['properties_id'],
                        "token" => $tokenAcceso
                    ]);

                /*
                ===============================================================
                Registro Planos
                ==============================================================*/

                $respuestaPlanos = Http::attach('PlanIMG[0]', fopen($datos["entrada_planos"][0]->getPathname(), 'r'), $datos["entrada_planos"][0]->getClientOriginalName(), [
                    'Content-Type' => $datos["entrada_planos"][0]->getMimeType()
                ]);

                foreach ($datos["entrada_planos"] as $index => $file)
                {
                    if ($index > 0)
                    {
                        $respuestaPlanos->attach("PlanIMG[$index]", fopen($file->getPathname(), 'r'), $file->getClientOriginalName(), [
                            'Content-Type' => $file->getMimeType()
                        ]);
                    }
                }

                $respuestaPlanos = $respuestaPlanos->post($this->ruta . '/api/planos/cargar', [
                    'PropertyId' => $propiedad['mensaje']['properties_id'],
                    "token" => $tokenAcceso
                ]);


                /*
                ===============================================================
                Registro Videos
                ==============================================================*/

                // //registraremos los codigos respectivos del proyecto.

                $codigos = explode(",", $datos["VideosProyecto"]);

                $respuestaVideos = Http::post($this->ruta . "/api/videos/cargar", [
                    "route" => $codigos,
                    "propertyId" => $propiedad["mensaje"]["properties_id"],
                    "token" => $tokenAcceso
                ]);


                /*
                ===============================================================
                Registro Coordenadas
                ==============================================================*/

                // registramos las coordenas de la propiedad.
                $coordenadasProyecto = $datos["ubicacionMapa"];

                $respuestaCoordenadas = Http::post($this->ruta . "/api/coordenadas/registrar", [
                    "coodenadas" => $coordenadasProyecto,
                    "propertyId" => $propiedad["mensaje"]["properties_id"],
                    "token" => $tokenAcceso
                ]);




                if (
                    $respuestaImagen->successful() &&
                    $respuestaPlanos->successful() &&
                    $respuestaVideos->successful() &&
                    $respuestaCoordenadas->successful()
                )
                {

                    /**
                     * ===============================================================
                     * ASIGNAR A LA PERSONA RESPONSABLE...
                     * ===============================================================
                     */

                    $repsuestaResponsable = Http::post($this->ruta . "/api/responsable/registrar", [
                        'idPropiedad' => $propiedad["id"],
                        'idUsuario' => $this->idUsuario,
                        'token' => $tokenAcceso
                    ]);

                    if ( !$repsuestaResponsable->successful() )
                    {
                        $body = json_decode($repsuestaResponsable->body(), true);
                        Alert::error('Registro Propiedad', 'Propiedad registrar.\n'.$body["mensaje"])
                        ->autoclose(5000);
                        return redirect('/propiedades');
                    }

                    Alert::success('Registro Propiedad', 'La propiedad ha sido registrado y asignada exitosamente')
                    ->autoclose(5000);
                    return redirect('/propiedades');
                }
                // dd("error guardar datos extras...");

                Alert::error('Registro Propiedad', 'No se pudo registrar ciertas caracteristicas de la propiedad')
                ->autoclose(5000);
                return redirect('/propiedades');
            }

            Alert::error('Registro Propiedad', 'Hubo unos errores al registrar propiedad')
            ->autoclose(5000);
            return redirect('/propiedades');
        }
        catch(\Exception $exception)
        {
            Alert::error('Error servidor', 'Intenta en otro momento el registro por favor')
            ->autoclose(5000);
            return redirect('/propiedades');
        }
    }



    public function eliminarPropiedad($id, Request $request)
    {
        try
        {
            /*
            Tomaremos el identificador de la propiedad que vamos a eliminar e internamente vamos a
            tener que consumir nuestra api para realizar la eliminacion respesctiva.
            */

            $tokenAcceso = explode(" ", $request->headers->get("Authorization"))[1];

            $respuesta = Http::delete($this->ruta . "/api/propiedades/eliminar", [
                "propiedadId" => $id,
                "token" => $tokenAcceso
            ]);

            $body = json_decode($respuesta->body(), true);

            if ( $respuesta->successful() )
            {

                Alert::success('Eliminacion Propiedad',  $body["mensaje"])
                ->autoclose(5000);
                return redirect('/propiedades');
            }

            Alert::error('Eliminacion Propiedad',  $body["mensaje"])
            ->autoclose(5000);
            return redirect('/propiedades');
        }
        catch(\Exception $e)
        {
            Alert::error('Error servidor', 'Intenta en otro momento la elminacion de la propiedad por favor')
            ->autoclose(5000);
            return redirect('/propiedades');
        }

    }
}

