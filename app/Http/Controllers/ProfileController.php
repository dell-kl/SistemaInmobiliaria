<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::with(['user', 'role'])->get();
        return view('gestionPerfiles.index', compact('profiles'));
    }

    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        $users = User::all();
        $roles = Role::all();
        return view('gestionPerfiles.edit', compact('profile', 'users', 'roles'));
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

        return redirect()->route('profiles.index')->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Perfil eliminado correctamente.');
    }
}