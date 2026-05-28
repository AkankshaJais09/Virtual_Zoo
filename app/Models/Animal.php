<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'name',
        'scientific_name',
        'habitat_id',
        'type',
        'diet',
        'conservation_status',
        'weight_kg',
        'lifespan_years',
        'speed_kmh',
        'fun_fact',
        'description',
        'image_path',
        'is_featured',
    ];

    /**
     * Get the habitat that this animal belongs to.
     */
    public function habitat()
    {
        return $this->belongsTo(Habitat::class);
    }

    public function favouritedBy() {
        return $this->hasMany(Favourite::class);
    }
}
