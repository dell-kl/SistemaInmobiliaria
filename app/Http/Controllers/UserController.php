<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $users = User::where('users_cedula', 'like', "%{$search}%")->get();
        } else {
            $users = User::all();
        }
        return view('moduloGestionUsuario.usuarios.index', compact('users'));
    }

    public function create()
{
    $roles = Role::all();
    return view('moduloGestionUsuario.usuarios.create', compact('roles'));
}



public function store(Request $request)
{
    $request->validate([
        'users_name' => 'required|string|regex:/^[A-Za-z\s]+$/|max:255',
        'users_email' => 'required|email|unique:users',
        'users_cedula' => 'required|digits:10|unique:users',
        'users_phone' => 'required|digits:10',
        'password' => 'required|string|min:6',
        'roles_id' => 'required|exists:roles,roles_id',
    ]);

    $user = User::create([
        'users_name' => $request->users_name,
        'users_email' => $request->users_email,
        'users_cedula' => $request->users_cedula,
        'users_phone' => $request->users_phone,
        'password' => Hash::make($request->password),
    ]);

    // Crear un registro en la tabla profile para asignar el rol al usuario
    Profile::create([
        'Profiles_usersId' => $user->users_id,
        'Profiles_rolesId' => $request->roles_id,
        'profiles_state' => 1, // Estado activo
    ]);

    return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
}

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('moduloGestionUsuario.usuarios.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('moduloGestionUsuario.usuarios.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'users_name' => 'required|string|max:255',
            'users_email' => 'required|email|unique:users,users_email,' . $id . ',users_id',
            'users_cedula' => 'required|string|max:10',
            'users_phone' => 'required|string|max:15',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'users_name' => $request->users_name,
            'users_email' => $request->users_email,
            'users_cedula' => $request->users_cedula,
            'users_phone' => $request->users_phone,
            'password' => $request->users_password ? Hash::make($request->users_password) : $user->users_password,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}