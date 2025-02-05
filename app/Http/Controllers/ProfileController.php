<?php

namespace App\Http\Controllers;

use App\Models\Authorization;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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


    public function update(Request $request, $id)
    {
        $request->validate([
            'Profiles_usersId' => 'required|exists:users,users_id',
            'Profiles_rolesId' => 'required|exists:roles,roles_id',
            'profiles_state' => 'required|boolean',
        ]);

        $profile = Profile::findOrFail($id);
        $profile->update($request->all());

        $permisos = $request->all()["permissions_id"];
        Http::post(config('app.url_api') . '/api/autorizaciones/actualizar', [
            'idPerfil' => $id,
            'permisos' => $permisos,
            'token' => JWTAuth::getToken()->get()
        ]);

        return redirect()->route('profiles.index')->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Perfil eliminado correctamente.');
    }
}
