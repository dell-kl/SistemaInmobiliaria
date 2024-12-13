<?php

namespace App\Http\Controllers;

use App\Network\Address;
use App\Tools\RequestTool;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GestionPropiedadController
{
    public function __construct() {}

    public function propiedad() : View
    {
        try {
            //code...
            $ruta = config('app.url_api') . "/api/propiedades/listar";
            $respuesta = Http::get($ruta);

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
            dd($request->all());
        }
        catch(\Exception $exception)
        {
            dd("Error ..." . $exception->getMessage());
        }
    }

}
