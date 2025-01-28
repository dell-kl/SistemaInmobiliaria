<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interest extends Model
{
    protected $fillable = [
        'interests_rate',
        'Interests_institutionsId',
    ];

    public function institution() : BelongsTo
    {
        return $this->belongsTo(Institution::class, 'Interests_institutionsId', 'institutions_id');
    }
}