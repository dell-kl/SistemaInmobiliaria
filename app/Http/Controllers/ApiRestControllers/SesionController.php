<?php
namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Services\SesionesServices;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

            if ( !$tokenGenerado )
            {
                return response()->json(['mensaje' => 'email o contraseña incorrecto'], 401);
            }
            else
            {
                return response()->json(['mensaje' => 'autorizado', 'token' => $tokenGenerado], 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => 'error servidor'], 500);
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
}
?>
