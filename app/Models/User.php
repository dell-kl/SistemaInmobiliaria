<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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
        'password',
        'users_intentos',
        'users_estado'
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        $d =  $this->profile();
        $r = $d->where('Profiles_usersId', '=', $this->users_id)->first()->obtenerRoles()->first()->roles_name;

        return [
            'id' => $this->users_id,
            'roles' => $r
        ];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'Profiles_usersId', 'users_id');
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