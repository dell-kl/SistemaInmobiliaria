<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $response = Http::get(config('app.url_api') . '/api/propiedades/listar');

        $propiedades = $response->json();

        return view('home.home', compact('propiedades'));
    }
}
