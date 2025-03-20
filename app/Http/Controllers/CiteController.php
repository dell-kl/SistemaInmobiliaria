<?php

namespace App\Http\Controllers;

use App\Models\Cite;
use App\Models\Profile;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CiteController extends Controller
{
    public function index()
    {
        //informacion de la persona que se autentico.
        $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
        //permisos que tiene el usuario.. en base a ello mostraremos lo que puede y no puede hacer.
        $permisos = JWTAuth::parseToken()->getPayload()->get('permisos');

        $cites = Cite::with(['profile', 'property'])->get();
        return view('cites.index', compact('cites', 'rolUsuario', 'permisos'));
    }

    public function create()
    {

        //informacion de la persona que se autentico.
        $rolUsuario = JWTAuth::parseToken()->getPayload()->get('roles');
        //permisos que tiene el usuario.. en base a ello mostraremos lo que puede y no puede hacer.
        $permisos = JWTAuth::parseToken()->getPayload()->get('permisos');

        $profiles = Profile::all();
        $properties = Property::all();
        return view('cites.create', compact( 'properties', 'rolUsuario', 'permisos'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'Cites_propertiesId' => 'required|exists:properties,properties_id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email',
            'appointment_date' => 'required|date',
            'notes' => 'required|string',
            'comments' => 'required|string',
        ]);

        Cite::create($request->all());

        //consumir el api rest para generarle un correo electronico.

        $ruta = config("app.url_api") . "/api/notificaciones/enviar/cita";

        $propiedad = Property::where('properties_id', $request->Cites_propertiesId)->first();

        $respuesta = Http::post($ruta, [
            "cita_cliente" => $request->client_name,
            "cita_fecha" => $request->appointment_date,
            "cita_propiedad" => $propiedad->properties_description,
            "cita_email" => $request->client_email,
            "cita_nota" => $request->notes,
            "cita_comentario" => $request->comments
        ]);

        return redirect()->route('cites.index')->with('success', 'Cita creada correctamente.');
    }

    public function edit(Cite $cite)
    {
        $profiles = Profile::all();
        $properties = Property::all();
        return view('cites.edit', compact('cite', 'profiles', 'properties'));
    }

    public function update(Request $request, Cite $cite)
    {
        $request->validate([

            'Cites_propertiesId' => 'required|exists:properties,properties_id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|string|max:15',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);

        $cite->update($request->all());

        return redirect()->route('cites.index')->with('success', 'Cita actualizada correctamente.');
    }
}
