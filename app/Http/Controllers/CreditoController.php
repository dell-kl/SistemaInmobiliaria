<?php
namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Property;
use App\Models\Interest;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function show($id)
    {
        $propiedad = Property::findOrFail($id);
        
        // Modificamos la consulta para incluir los intereses asociados
        $instituciones = Institution::with('interests')
            ->select('institutions.*')
            ->join('interests', 'institutions.institutions_id', '=', 'interests.Interests_institutionsId')
            ->get();

        return view('home.simularCredito', compact('propiedad', 'instituciones'));
    }

    // Método adicional para obtener el interés vía AJAX si lo necesitas
    public function getInteres($institucionId)
    {
        $interes = Interest::where('Interests_institutionsId', $institucionId)
            ->first();
            
        if (!$interes) {
            return response()->json([
                'error' => 'No se encontró tasa de interés para esta institución'
            ], 404);
        }

        return response()->json([
            'tasa' => $interes->interests_rate
        ]);
    }
}