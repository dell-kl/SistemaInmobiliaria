<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Interest;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class InstitutionController extends Controller
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

        $institutions = Institution::with('interests')->get();
        return view('institutions.index', compact('institutions', 'rolUsuario', 'permisos'));
    }

    public function create()
    {
        return view('institutions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'institutions_name' => 'required',
            'institutions_terms' => 'required',
            'institutions_dateRegist' => 'required|date',
            'interests_rate' => 'required|numeric',
        ]);

        $institution = Institution::create($request->only(['institutions_name', 'institutions_terms', 'institutions_dateRegist']));
        $institution->interests()->create(['interests_rate' => $request->interests_rate]);

        return redirect()->route('institutions.index');
    }

    public function show(Institution $institution)
    {
        $institution->load('interests');
        return view('institutions.show', compact('institution'));
    }

    public function edit(Institution $institution)
    {
        return view('institutions.edit', compact('institution'));
    }

    public function update(Request $request, Institution $institution)
    {
        $request->validate([
            'institutions_name' => 'required',
            'institutions_terms' => 'required',
            'institutions_dateRegist' => 'required|date',
            'interests_rate' => 'required|numeric',
        ]);

        $institution->update($request->only(['institutions_name', 'institutions_terms', 'institutions_dateRegist']));
        $institution->interests()->update(['interests_rate' => $request->interests_rate]);

        return redirect()->route('institutions.index');
    }

    public function destroy(Institution $institution)
    {
        $institution->delete();
        return redirect()->route('institutions.index');
    }
}
