<?php
// app/Models/Institution.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions';
    protected $primaryKey = 'institutions_id';

    protected $fillable = [
        'institutions_name',
        'institutions_terms',
        'institutions_dateRegist',
    ];

    // Definimos la relación con el modelo Interest
    public function interests() : HasMany
    {
        return $this->hasMany(Interest::class, 'Interests_institutionsId', 'institutions_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($institution) {
            $institution->interests()->delete();
        });
    }
}