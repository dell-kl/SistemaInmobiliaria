<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Profile;
use App\Models\User;
use App\Models\Property;
use App\Models\TypeProperty;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        /**
         * Variables de sesion. 
         *  */


        //informacion de la persona que se autentico.
        $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
        //permisos que tiene el usuario.. en base a ello mostraremos lo que puede y no puede hacer.
        $permisos = JWTAuth::parseToken()->getPayload()->get('permisos');


        $numPerfiles = Profile::count();
        $numUsuariosActivos = User::where('users_estado', 'activo')->count();
        $numPropiedades = Property::count();
        $tiposPropiedades = TypeProperty::all();

        return view('reportes.index', compact( 
            'numPerfiles', 'numUsuariosActivos', 
            'numPropiedades', 'tiposPropiedades', 
            'rolUsuario', 'permisos'));
    }
}