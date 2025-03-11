<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Models\Authorization;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller {

    public function __construct()
    {

    }

    public function encontrarUsuario(Request $request)
    {
        try {
            //code...
            $usuario = User::where('users_email', $request->email)->get();

            if ( $usuario->isEmpty() ) {
                return response()->json(['mensaje' => 'usuario no encontrado'], 500);
            }

            return response()->json(['mensaje' => $usuario->first()], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => 'usuario no encontrado'], 500);
        }
    }

    public function crearUsuario(Request $request)
    {
        try {
            //code...
            if (
                isset($request->users_name) &&
                isset($request->users_phone) &&
                isset($request->users_cedula) &&
                isset($request->users_email) &&
                isset($request->users_password) &&
                isset($request->rol)
            )
            {
                //tomaremos los datos... y nos encargaremos de verificar si no hay alguien con la cedula y con el email.
                $resultado = User::where('users_cedula', '=', $request->users_cedula)
                ->orWhere('users_email', '=', $request->users_email)
                ->orWhere('users_phone', '=', $request->users_phone)
                ->exists();

                $idRol = Role::where('roles_name', '=', $request->rol);

                if ( !$resultado && $idRol->exists() )
                {
                    $idRol = $idRol->first()->roles_id;

                    $usuario = new User();
                    $usuario->users_name = $request->users_name;
                    $usuario->users_phone = $request->users_phone;
                    $usuario->users_cedula = $request->users_cedula;
                    $usuario->users_email = $request->users_email;
                    $usuario->password = Hash::make($request->users_password);
                    $usuario->users_intentos = 3;
                    $usuario->users_estado = 'activo';
                    $usuario->save();

                    //creamos un perfil para esta persona.
                    $idUsuarioRegistrado = User::latest()->first()->users_id;

                    $perfil = new Profile();
                    $perfil->Profiles_usersId = $idUsuarioRegistrado;
                    $perfil->Profiles_rolesId = $idRol;
                    $perfil->profiles_state = 1;
                    $perfil->save();

                    //luego de este vamos a tener que  darle los permisos.
                    $idPerfil = Profile::latest()->first()->profiles_id;

                    if ( $request->rol === 'cliente' )
                    {
                        $permiso = new Authorization();
                        $permiso->authorizations_profilesId = $idPerfil;
                        $permiso->authorizations_permissionId = 4;
                        $permiso->save();
                    }

                    return response()->json(['mensaje' => 'usuario creado'], 200);
                }

                return response()->json(['mensaje' => 'ya existe un usuario con estos datos'], 500);
            }

            return response()->json(['mensaje' => 'Algunos datos sin definir'], 500);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => $th->getMessage()], 500);
        }
    }
}
?>
