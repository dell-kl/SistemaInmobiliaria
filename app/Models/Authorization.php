<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Authorization extends Model
{
    //

    //dentro de nuestro authorization vamos a traernos los permisos correspondientes.

    public function permisos() : BelongsTo
    {
        return $this->belongsTo(Permission::class, 'authorizations_permissionsId', 'permissions_id');
    }
}
