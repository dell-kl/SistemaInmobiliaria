<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    //realiza la configuracion de las relaciones para obtener la informacion correspondiente de las coordenadas.

    protected $primaryKey = 'coordinates_id';

    protected $fillable = [
        'coordinates_id',
        'coordinates_route',
        'coordinates_propertiesId'
    ];
}
