<?php

namespace App\Http\Controllers;

use App\Models\Authorization;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{
    public function index()
    {
        /**
         * VARIABLES PARA VERIFICAR PERMISOS Y ROL DEL USUARIO.
         */

        //informacion de la persona que se autentico.
        $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
        //permisos que tiene el usuario.. en base a ello mostraremos lo que puede y no puede hacer.
        $permisos = JWTAuth::parseToken()->getPayload()->get('permisos');

        $profiles = Profile::with(['user', 'role'])->get();

        return view('gestionPerfiles.index', compact('profiles', 'rolUsuario', 'permisos'));
    }

    public function edit($id)
    {
        /**
         * VARIABLES PARA VERIFICAR PERMISOS Y ROL DEL USUARIO.
         */

        //informacion de la persona que se autentico.
        $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
        //permisos que tiene el usuario.. en base a ello mostraremos lo que puede y no puede hacer.
        $permisos = JWTAuth::parseToken()->getPayload()->get('permisos');

        $profile = Profile::findOrFail($id);
        $users = User::all();
        $roles = Role::all();

        $autorizacionesPerfil = Authorization::where('authorizations_profilesId', $id)->get()
        ->select('authorizations_permissionId')->toArray();

        return view('gestionPerfiles.edit', compact('profile', 'users', 'roles', 'rolUsuario', 'permisos', 'autorizacionesPerfil'));
    }

    /**
     * Una funcion de busqueda.. ponerla despues en la carpeta /tools para que quede mejor adaptada.
     */
    public function buscarDesincluidos($authorization, Request $request)
    {
        $item = array_filter($authorization, function($item) use ( $request ) {

            if ( !in_array($item['authorizations_permissionId'], $request->permissions_id) )
            {
                return $item;
            }
        });

        $item = array_values($item);

        if ( !empty($item) )
        {
            foreach ($item as $value) {
                $auth = new Authorization();
                $auth->authorizations_id = $value["authorizations_id"];
                $auth->authorizations_profilesId = $value["authorizations_profilesId"];
                $auth->authorizations_permissionId = $value["authorizations_permissionId"];
                $auth->delete();
            }
        }

    }

    public function buscarXIncluir($id, REquest $request)
    {
        $authorization = Authorization::where('authorizations_profilesId', $id)->get()->select('authorizations_permissionId')->toArray();

        $item = array_filter($request->permissions_id, function($item)use ($authorization) {

            if ( !in_array(['authorizations_permissionId' => $item], $authorization)) {
                return $item;
            }
        });

        if ( !empty($item) )
        {
            foreach ($item as $value) {
                $authorization = new Authorization();
                $authorization->authorizations_profilesId = $id;
                $authorization->authorizations_permissionId = $value;
                $authorization->save();
            }
        }
    }

    public function update(Request $request, $id)
    {



        $request->validate([
            'Profiles_usersId' => 'required|exists:users,users_id',
            'Profiles_rolesId' => 'required|exists:roles,roles_id',
            'profiles_state' => 'required|boolean',
        ]);

        $profile = Profile::findOrFail($id);
        $profile->update($request->all());

        //verificar cual permiso ya no se encuentra o si ya hay mas permisos.
        $authorization = Authorization::where('authorizations_profilesId', $id)->get()->toArray();
        if ( count($request->permissions_id) < count($authorization) )
        {
            $this->buscarDesincluidos($authorization, $request);
            // por los de incluir que sean distintos.
            // $this->buscarXIncluir($id, $request);
        }
        else if ( count($request->permissions_id) > count($authorization) )
        {
            $this->buscarXIncluir($id, $request);
        }


        return redirect()->route('profiles.index')->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Perfil eliminado correctamente.');
    }
}
