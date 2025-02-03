<?php
// app/Models/Profile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{


    protected $primaryKey = 'profiles_id';

    protected $fillable = [
        'Profiles_usersId',
        'Profiles_rolesId',
        'profiles_state',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'Profiles_usersId', 'users_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'Profiles_rolesId', 'roles_id');
    }

    public function authorizations() : HasMany
    {
        return $this->hasMany(Authorization::class, 'authorizations_profilesId', 'profiles_id');
    }

    public function obtenerUser():HasMany {
        return $this->hasMany(User::class, 'Profiles_usersId', 'users_id');
    }

    public function obtenerRoles():BelongsTo {
        return $this->belongsTo(Role::class, 'Profiles_rolesId', 'roles_id');
    }

}

