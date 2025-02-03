<?php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        /**
         * VARIABLES PARA VERIFICAR PERMISOS Y ROL DEL USUARIO.
         */

        //informacion de la persona que se autentico.
        $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
        //permisos que tiene el usuario.. en base a ello mostraremos lo que puede y no puede hacer.
        $permisos = JWTAuth::parseToken()->getPayload()->get('permisos');


        $roles = Role::all();
        return view('roles.index', compact('roles', 'rolUsuario', 'permisos'));
    }

    public function create()
    {
                /**
         * VARIABLES PARA VERIFICAR PERMISOS Y ROL DEL USUARIO.
         */

        //informacion de la persona que se autentico.
        $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
        //permisos que tiene el usuario.. en base a ello mostraremos lo que puede y no puede hacer.
        $permisos = JWTAuth::parseToken()->getPayload()->get('permisos');


        return view('roles.create', compact('rolUsuario', 'permisos'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'roles_name' => 'required|string|max:255',
            'roles_estado' => 'required|boolean',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    public function show(Role $role)
    {
                /**
         * VARIABLES PARA VERIFICAR PERMISOS Y ROL DEL USUARIO.
         */

        //informacion de la persona que se autentico.
        $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
        //permisos que tiene el usuario.. en base a ello mostraremos lo que puede y no puede hacer.
        $permisos = JWTAuth::parseToken()->getPayload()->get('permisos');


        return view('roles.show', compact('role', 'rolUsuario', 'permisos'));
    }

    public function edit(Role $role)
    {

        /**
         * VARIABLES PARA VERIFICAR PERMISOS Y ROL DEL USUARIO.
         */

        //informacion de la persona que se autentico.
        $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
        //permisos que tiene el usuario.. en base a ello mostraremos lo que puede y no puede hacer.
        $permisos = JWTAuth::parseToken()->getPayload()->get('permisos');


        return view('roles.edit', compact('role', 'rolUsuario', 'permisos'));
    }

    public function update(Request $request, Role $role)
    {

        $request->validate([
            'roles_name' => 'required|string|max:255',
            'roles_estado' => 'required|boolean',
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}
