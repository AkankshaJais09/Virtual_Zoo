<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitat;

class ExploreController extends Controller
{
    /**
     * Display a listing of the habitats.
     */
    public function index()
    {
        $habitats = Habitat::all();

        return view('explore.index', compact('habitats'));
    }

    /**
     * Display the specified habitat and its resident animals.
     */
    public function show(Habitat $habitat)
    {
        $habitat->load('animals');

        return view('explore.show', compact('habitat'));
    }
}
