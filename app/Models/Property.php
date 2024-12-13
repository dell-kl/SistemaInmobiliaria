<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    //imagenes
    public function images() : HasMany
    {
        return $this->hasMany(Picture::class, 'Pictures_propertiesId', 'properties_id');
    }

    //videos
    public function videos() : HasMany
    {
        return $this->hasMany(Video::class, 'videos_propertiesId', 'properties_id');
    }

    //planos
    public function planos() : HasMany
    {
        return $this->hasMany(Plan::class, 'Plans_propertiesId', 'properties_id');
    }

    //tipo de propiedad
    public function obtenerTipoPropiedad() : BelongsTo
    {
        return $this->belongsTo(TypeProperty::class, 'Properties_typePropertieId', 'typeProperties_id');
    }

    //ubicacion.. el cual esta unido con nuestra entidad de parroquia.
    public function obtenerUbicacion() : BelongsTo
    {
        return $this->belongsTo(Parroquia::class, 'Properties_parroquiasId', 'parroquias_id');
    }

}
