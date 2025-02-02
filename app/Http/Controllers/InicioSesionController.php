<?php
namespace App\Http\Controllers;

use App\Mail\NotificacionCorreo;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTFactory;
use RealRashid\SweetAlert\Facades\Alert;
use Tymon\JWTAuth\Payload;

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
           return redirect('/login');
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
                else if ( $respuesta->getStatusCode() === 500 )
                {
                    Alert::error('Inicio Sesion', $body["mensaje"])
                    ->autoclose(10000);
                }

              //redireccionamos a la persona por datos invalidos.
                return redirect('/login');
            }
        }
        catch(Exception $e)
        {
            Alert::error('Inicio Sesion', $body["mensaje"])
            ->autoclose(5000);
          //redireccionamos a la persona por datos invalidos.
            return redirect('/login');
        }
    }




    /**
     * ==========================================================
     * PROCESO PARA REALIZAR EL RESETEO DE LAS PASSWORDS
     * ==========================================================
     */


    public function reset()
    {
        //llamamos a nuestra vista para poder hacer el reseteo de las claves.
        return View('moduloSeguridad.reset');
    }

    //este esta configurado con un metodo post para que envie un correo electornico a la persona
    //que solicituo justamente este cambio de password.
    public function resetPost(Request $request)
    {
        try {
            //primero vamos a verificar si dicho usuario existe con el correo en nuestra base de datos...
            $url = config('app.url_api') . '/api/usuario/verificar';

            $respuesta = Http::post($url, [
                "email" => $request->email
            ]);


            if ( $respuesta->getStatusCode() === 200 )
            {

                $body = $respuesta->json();
                $usuario = new User();
                $usuario = $body["mensaje"];

                //vamos a generar el email pero encriptado.

                $token = Crypt::encrypt($usuario["users_email"]);

                Mail::to($request->email)->send(new NotificacionCorreo($token));
                Alert::success('Restaurar contraseña', "Se ha enviado un correo para reestablecer contraseña")
                ->autoclose(10000);

                return redirect('/reset');
            }

            //code...
            Alert::error('Restaurar contraseña', "Ha ocurrido un problema al enviar un correo para reestablecer contraseña")
            ->autoclose(10000);
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            Alert::error('Restaurar contraseña', "No es posible enviar un correo para reestablecer contraseña")
            ->autoclose(10000);
        }


        return redirect('/reset');
    }

    //vamos a crear un metodo de configuracion del cual de aqui este estara
    //unido con la vista donde si se podran las password nuva y tedremos que hacer una reset de
    //esta cuenta nueva.... antes hay que validar con middleware si realmente esta persona recibio un token
    //de proceso de restauracion de password.
    public function procesoResetPost(Request $request)
    {
        /**
         * Vamos a sacar informacion del token cuando se pase como por ejemplo cual fue el correo que quizo el
         * cambio de la clave.
         */

        $token_string = $request->token_generate_rst;

        $correo = Crypt::decrypt($token_string);

        //luego tendremos que realizar el reseteo respectivo de las credenciales.
        $url = config('app.url_api') . '/api/auth/reset';

        $respuesta = Http::post($url, [
            "email" => $correo,
            "password" => $request->password
        ]);

        $body = $respuesta->json();
        if ( $respuesta->getStatusCode() === 200 )
        {

            Alert::success('Restaurar contraseña', $body["mensaje"])
            ->autoclose(10000);

        }
        else
        {
            Alert::error('Restaurar contraseña', $body["mensaje"])
            ->autoclose(10000);
        }

        return redirect('/proceso-reseteo/'. $token_string);
    }

    public function procesoReset($token)
    {
        return View('moduloSeguridad.procesoReset',
    [
        "token" => $token
         ]);
    }
}
