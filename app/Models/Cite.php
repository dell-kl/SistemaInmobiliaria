<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cite extends Model
{
    protected $primaryKey = 'cites_id';

    protected $fillable = [
        
        'Cites_propertiesId',
        'client_name',
        'client_email',
        'appointment_date',
        'notes',
        'comments'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'Cites_profilesId', 'profiles_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'Cites_propertiesId', 'properties_id');
    }
}