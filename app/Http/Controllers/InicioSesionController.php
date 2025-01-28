<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InicioSesionController extends Controller
{
    private string $ruta;

    public function __construct() {
        $this->ruta = config("app.url_api");
    }

    public function index() {

        return View('moduloSeguridad.login');
    }

    public function logout(Request $request)
    {

        $token = $request->cookie('Authorization');
        $token = explode(" ", $token)[1];

        $respuesta = Http::post($this->ruta . "/api/auth/cerrar", [
            "token" => $token
       ]);

       $body = json_decode($respuesta->body(), true);

       if ( $body["mensaje"] === "Sesion cerrada" )
       {
           return redirect('/');
       }
    }

    public function auth(Request $request)
    {
        //gestion respectivo del perfil del cliente...
        try
        {
            $respuesta = Http::post($this->ruta . "/api/auth/sesion", [
                "email" => $request["email"],
                "password" => $request["password"]
            ]);

            $body = json_decode($respuesta->body(), true);

            if ( $body["mensaje"] === "autorizado" ) {
                $tokenAutorizacion = "Bearer ". $body["token"];

                return redirect('/propiedades')->withCookie('Authorization', $tokenAutorizacion);
            }
            else
            {
              //redireccionamos a la persona por datos invalidos.
                return redirect('/');
            }
        }
        catch(Exception $e)
        {
            //regresarlos al formulario en caso de error.
        }
    }
}
