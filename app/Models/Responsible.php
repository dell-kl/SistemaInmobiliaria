<?php
// app/Models/Responsible.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Responsible extends Model
{
    /*use HasFactory;

    protected $primaryKey = 'responsibles_id';

    protected $fillable = [
        'Responsibles_propertiesId',
        'Responsibles_usersId',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'Responsibles_usersId', 'users_id');
    }
}*/
    //

    public function properties(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
