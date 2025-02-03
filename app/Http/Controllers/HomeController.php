<?php
namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $queryParams = [
            'tipo' => $request->input('tipo'),
            'habitaciones' => $request->input('habitaciones'),
            'precio_min' => $request->input('precio_min'),
            'precio_max' => $request->input('precio_max'),
        ];

        $response = Http::get(config('app.url_api') . '/api/propiedades/listar', $queryParams);

        if ($response->successful()) {
            $propiedades = $response->json();
        } else {
            $propiedades = [];
        }

        return view('home.home', compact('propiedades'));
    }

    public function simularCredito($id)
    {
        $propiedad = Property::findOrFail($id);
        $instituciones = Institution::all();
        return view('home.simularCredito', compact('propiedad', 'instituciones'));
    }
}