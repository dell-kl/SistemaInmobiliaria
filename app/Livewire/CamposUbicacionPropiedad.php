<?php

namespace App\Livewire;

use App\Models\Canton;
use App\Models\Parroquia;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CamposUbicacionPropiedad extends Component
{
    public array $Listadocantones;
    public array $ListadoParroquias;

    public int $idCanton = 0;

    public function render() : View
    {
        //pasar la infromacion de todos los cantones.
        $Listadocantones = Canton::all();
        
        //vamos a revisar si podemos filtrar por medio del canton que selecciono. 
        $ListadoParroquias = ($this->idCanton===0) ? []
            : Parroquia::Where('Parroquias_cantonsId', $this->idCanton)->get()->toArray();

        return view('livewire.campos-ubicacion-propiedad')->with([
            'cantones' => $Listadocantones,
            'parroquias' => $ListadoParroquias
        ]);
    }

    //esta opcion de aqui se va a ejecutar cuando seleccionemos un canto disponible.
    public function cantonOpcion() : void
    {
        $canton = Canton::Where('cantons_id', $this->idCanton)->first();
        $ListadoParroquias = $canton->obtenerParroquias();
        
    }
}
