<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institution extends Model
{

    //podemos definir la parte de las relaciones.   
    public function interests() : HasMany
    {
        return $this->hasMany(Interest::class, 'interests_institutionsId', 'institutions_id');
    }
}
