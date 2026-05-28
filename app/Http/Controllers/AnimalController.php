<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;

class AnimalController extends Controller
{
    /**
     * Display a listing of the animals.
     */
    public function index()
    {
        $animals = Animal::with('habitat')->get();

        return view('animals.index', compact('animals'));
    }

    public function show(Animal $animal)
    {
        $animal->load('habitat');
        
        if (auth()->check()) {
            \App\Models\Activity::create([
                'user_id' => auth()->id(),
                'type' => 'view_animal',
                'description' => auth()->user()->name . ' viewed the details for ' . $animal->name . '.',
                'animal_id' => $animal->id,
            ]);
        }
        
        $similarAnimals = Animal::where('habitat_id', $animal->habitat_id)
            ->where('id', '!=', $animal->id)
            ->limit(3)
            ->get();

        return view('animals.show', compact('animal', 'similarAnimals'));
    }
}
