<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parroquia extends Model
{
    //

    //vamos a definir la respectiva relacion
    public function obtenerCanton() : BelongsTo
    {
        return $this->belongsTo(Canton::class, 'Parroquias_cantonsId', 'cantons_id');
    }
}
