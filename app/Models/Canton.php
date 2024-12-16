<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Canton extends Model
{

    //configuracion de las relaciones correspondientes.
    public function obtenerParroquias() : HasMany
    {
        return $this->hasMany(Parroquia::class, 'Parroquias_cantonsId', 'cantons_id');
    }
}
