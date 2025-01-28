<?php
// app/Models/Profile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

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
}