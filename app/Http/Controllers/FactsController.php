<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Habitat;

class FactsController extends Controller
{
    public function index()
    {
        // Fetch 6 random animals with their habitat relationship loaded
        $animals = Animal::with('habitat')->inRandomOrder()->limit(6)->get();

        // Calculate statistics
        $stats = [
            'total_animals' => Animal::count(),
            'endangered' => Animal::where('conservation_status', 'Endangered')
                ->orWhere('conservation_status', 'Critically Endangered')
                ->count(),
            'habitats' => Habitat::count(),
            'countries' => 195, // Hardcoded
        ];

        return view('facts.index', compact('animals', 'stats'));
    }
}
