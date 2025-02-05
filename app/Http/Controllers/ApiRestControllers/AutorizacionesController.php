<?php

namespace App\Http\Controllers\ApiRestControllers;
use App\Http\Controllers\Controller;
use App\Models\Authorization;
use Illuminate\Http\Request;

class AutorizacionesController extends Controller
{
    public function __construct() {}

    public function listarAutorizaciones() {
        try {

            $autorizaciones = Authorization::all();
            return response()->json(['mensaje' => $autorizaciones], 200);
       } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'autorizaciones no encontrados'], 500);
       }
    }

    //este de aqui nos servira para realizar una autorizacion justamente del perfil que ya se genero.
    public function editarAutorizaciones(Request $request)
    {
        try {
            //vamos a realizar una busqueda por los nuevos permisos.
            $autorizacionPerfil = Authorization::where('authorizations_profilesId', '=', $request->idPerfil)->get();

            if ( !$autorizacionPerfil->isEmpty() )
            {
                $permisosDB = $autorizacionPerfil->select('authorizations_permissionId')->toArray();
                $listadoPermisos = $request->permisos;

                //buscamos por si hay permisos nuevos.
                $permisosNuevo = array_filter($listadoPermisos, function($value) use ($permisosDB) {
                    if (!in_array(['authorizations_permissionId' => $value], $permisosDB))
                    {
                        return $value;
                    }
                });


                if ( !empty($permisosNuevo) )
                {
                    foreach($permisosNuevo as $key=>$value)
                    {
                        $authorization = new Authorization();
                        $authorization->authorizations_profilesId = $request->idPerfil;
                        $authorization->authorizations_permissionId = $value;
                        $authorization->save();
                    }
                }


                //buscamos por los codigos que van a ser reemplazados ...
                $permisosAEliminar = array_filter($permisosDB, function($value) use ($listadoPermisos) {

                    $permiso = $value["authorizations_permissionId"];

                    if ( !in_array($permiso, $listadoPermisos) )
                    {
                        return $value["authorizations_permissionId"];
                    }

                });


                if ( !empty($permisosAEliminar) )
                {

                    $permisosFiltradosAEliminar = $autorizacionPerfil->filter(function($permiso) use ($permisosAEliminar) {

                        $permisoId = $permiso->authorizations_permissionId;

                        if ( in_array(['authorizations_permissionId' => $permisoId], $permisosAEliminar) )
                        {
                            return $permiso;
                        }

                    });

                    foreach($permisosFiltradosAEliminar as $permiso)
                        Authorization::where('authorizations_id', $permiso->authorizations_id)->delete();
                }

            }

            return response()->json(['mensaje' => 'permisos actualizados'], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['mensaje' => 'permisos no actualizados'], 500);
        }

    }
}
?>
