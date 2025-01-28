<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    //

    public function obtenerUser():HasMany {
        return $this->hasMany(User::class, 'Profiles_usersId', 'users_id');
    }

    public function obtenerRoles():BelongsTo {
        return $this->belongsTo(Role::class, 'Profiles_rolesId', 'roles_id');
    }

}
