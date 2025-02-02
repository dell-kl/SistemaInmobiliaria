<?php
namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SesionesServices;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class SesionController extends Controller {
    private SesionesServices $sesionService;

    public function __construct(SesionesServices $sesiones) {

        //configuracion con la parte del middleware.
        $this->sesionService = $sesiones;
    }

    public function inicioSesion(Request $request) : JsonResponse {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|max:15',

        ]);

        if ( $validator->fails()  )
        {
            return response()->json(['mensaje' => 'formato incorrecto'], 422);
        }

        try {
            //code...
            $tokenGenerado = JWTAuth::attempt(['users_email' => $request->email, 'password' => $request->password]);

            $usuarioVerificar = User::where('users_email', '=', $request->email)->first();

            if ( !$tokenGenerado )
            {
                /**
                 * Aqui tenemos que realizar una configuracion para tener que ir reduciendo el numero de intentos del
                 * usuario que introdujo mal la contraseña....
                 * Pero debemos verificar si el email existe en la base de datos.
                 */

                if ( isset($usuarioVerificar) && $usuarioVerificar->users_intentos > 0 )
                {
                    $usuarioVerificar->users_intentos -= 1;
                    $usuarioVerificar->save();

                    return response()->json(['mensaje' => 'Email o contraseña incorrecto', 'intentos' => $usuarioVerificar->users_intentos], 401);
                }
                else if ( isset($usuarioVerificar) && $usuarioVerificar->users_intentos == 0 )
                {
                    $usuarioVerificar->users_estado = 'inactivo';
                    $usuarioVerificar->save();

                    return response()->json(['mensaje' => 'Cuenta bloqueada, contacta con el administrador', 'intentos' => $usuarioVerificar->users_intentos], 403);
                }

                return response()->json(['mensaje' => 'Email o contraseña incorrecto'], 404);
            }
            else
            {
                //tenemos que hacer una comprobacion adicional... solamente entregamos token a cuentas
                //con estado activo y con un nivel de intentos superior a 0.

                if ( $usuarioVerificar->users_intentos > 0 && $usuarioVerificar->users_estado == 'activo' )
                {
                    return response()->json(['mensaje' => 'autorizado', 'token' => $tokenGenerado], 200);
                }
                else
                {
                    return response()->json(['mensaje' => 'Cuenta bloqueada, contacta con el administrador', 'intentos' => $usuarioVerificar->users_intentos], 403);
                }
            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => $th->getMessage()], 500);
        }

    }

    public function cerrarSesion(Request $request) : JsonResponse {

        try
        {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['mensaje' => 'Sesion cerrada'], 200);
        }
        catch (Exception $exception )
        {
            return response()->json(['mensaje' => "Error en cerrar la sesion " . $exception->getMessage()], 500);
        }
    }

    public function reset(Request $request)
    {
        try {
            //code...
            $passwordNuevo = $request->password;
            $email = $request->email;

            //seteo respectivo de los datos.
            $usuario = User::where('users_email', $email)->get();

            if ( $usuario->isEmpty() )
            {
                return response()->json(['mensaje' => 'no se puedo actualizar la contrasena'], 500);
            }

            $usuario = $usuario->first();

            $usuario->password = Hash::make($passwordNuevo);

            $usuario->save();

            return response()->json(['mensaje' => 'contrasena actualizada'], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => 'No se puedo actualizar la contrasena'], 500);
        }
    }
}
?>
