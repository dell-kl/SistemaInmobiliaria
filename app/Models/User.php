<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'users_id';

    //con este atributo definimos con que tabla va a estar relacionado este atributo . 
    // protected $table = "Usuarios";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_name',
        'users_email',
        'users_cedula',
        'users_phone',
        'users_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'users_password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAuthIdentifierName()
    {
        return 'users_email';
    }

    public function roles() : HasManyThrough
    {
        return $this->hasManyThrough(Role::class, Profile::class, 'Profiles_usersId', 'roles_id', 'users_id', 'Profiles_rolesId');
    }

    public function profiles() : HasMany
    {
        return $this->hasMany(Profile::class, 'Profiles_usersId', 'users_id');
    }

    public function responsibles()
    {
        return $this->hasMany(Responsible::class, 'Responsibles_usersId', 'users_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->profiles()->delete();
            $user->responsibles()->delete();
        });
    }
}