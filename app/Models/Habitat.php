<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitat extends Model
{
    protected $fillable = [
        'name',
        'description',
        'climate',
        'region',
        'image_path',
        'color_theme',
    ];

    /**
     * Get the animals in this habitat.
     */
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
