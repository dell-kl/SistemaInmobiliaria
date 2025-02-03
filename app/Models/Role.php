<?php
// app/Models/Role.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $primaryKey = 'roles_id';

    public function profiles() : HasMany
    {
        return $this->hasMany(Profile::class, 'Profiles_rolesId', 'roles_id');
    }

    public function authorizations() : HasMany
    {
        return $this->hasMany(Authorization::class, 'authorizations_rolId', 'roles_id');
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Profile::class, 'Profiles_rolesId', 'users_id', 'roles_id', 'Profiles_usersId');
    }
}
