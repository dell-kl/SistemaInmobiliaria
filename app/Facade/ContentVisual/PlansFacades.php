<?php

namespace App\Facade\ContentVisual;

use App\Services\PlansServices;
use Illuminate\Support\Facades\Http;

class PlansFacades {

    private PlansServices $plansServices;

    public function __construct(PlansServices $plansServices)
    {
        $this->plansServices = $plansServices;
    }

    public function registerPlans($imagenes, $idPropiedad)
    {
        $respuestaPlanos = Http::attach(
            'PlanIMG[0]',
            fopen($imagenes[0]->getPathname(), 'r'),
            $imagenes[0]->getClientOriginalName(),
            [ 'Content-Type' => $imagenes[0]->getMimeType() ]
        );

        foreach ($imagenes as $index => $file)
        {
            if ( $index > 0 )
            {
                $respuestaPlanos->attach(
                    "PlanIMG[$index]",
                    fopen($file->getPathname(), 'r'),
                    $file->getClientOriginalName(),
                    [ 'Content-Type' => $file->getMimeType() ]
                );
            }
        }

        return $this->plansServices->registrarPlan($respuestaPlanos, $idPropiedad);
    }

    // Puedes agregar más métodos para otras operaciones relacionadas con planes
}
?>
