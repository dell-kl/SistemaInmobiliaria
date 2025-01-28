<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Responsible extends Model
{
    //

    public function properties(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
