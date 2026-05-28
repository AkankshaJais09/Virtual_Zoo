<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model {
    protected $fillable = ['user_id', 'animal_id'];

    public function animal() {
        return $this->belongsTo(Animal::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
