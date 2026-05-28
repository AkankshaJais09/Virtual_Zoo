<?php

namespace App\Http\Controllers;

use App\Models\Habitat;
use App\Models\Animal;

class VisitController extends Controller
{
    public function index()
    {
        $habitats = Habitat::with('animals')->get();
        $totalAnimals = Animal::count();

        return view('visit.index', compact('habitats', 'totalAnimals'));
    }
}
