<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

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

                if ( $respuesta->getStatusCode() === 403 )
                {
                    Alert::error('Inicio Sesion', $body["mensaje"])
                    ->autoclose(10000);
                }
                else if ( $respuesta->getStatusCode() === 404 )
                {
                    Alert::error('Inicio Sesion', $body["mensaje"])
                    ->autoclose(10000);
                }
                else if ( $respuesta->getStatusCode() === 401 )
                {
                    Alert::error('Inicio Sesion', $body["mensaje"]. ". Tienes " . $body["intentos"] . " intentos disponibles.!!!!")
                    ->autoclose(10000);
                }

              //redireccionamos a la persona por datos invalidos.
                return redirect('/');
            }
        }
        catch(Exception $e)
        {
            Alert::error('Inicio Sesion', $body["mensaje"])
            ->autoclose(5000);
          //redireccionamos a la persona por datos invalidos.
            return redirect('/');
        }
    }
}
