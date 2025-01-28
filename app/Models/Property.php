<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{

    protected $primaryKey = "properties_id";

    protected $fillable = [
        "properties_id",
        "properties_rooms",
        "properties_bathrooms",
        "properties_parking",
        "properties_price",
        "properties_availability",
        "properties_height",
        "properties_area",
        "properties_description",
        "properties_state",
        "properties_address",
        "Properties_typePropertieId",
        "Properties_parroquiasId"
    ];

    public function responsible() : HasMany
    {
        return $this->hasMany(Responsible::class, 'Responsibles_propertiesId', 'properties_id');
    }

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

    //obtener informacion sobre las coordenadas de la propiedad.
    public function obtenerCoordenadas() : HasMany
    {
        return $this->hasMany(Coordinate::class, 'coordinates_propertiesId', 'properties_id');
    }
}
