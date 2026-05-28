<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Animal;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function index() {
        $favourites = auth()->user()
            ->favourites()
            ->with('animal')
            ->get()
            ->pluck('animal');
        return view('favourites.index', compact('favourites'));
    }

    public function toggle(Request $request) {
        $request->validate(['animal_id' => 'required|exists:animals,id']);
        $user = auth()->user();
        $animalId = $request->animal_id;

        $existing = Favourite::where('user_id', $user->id)
                             ->where('animal_id', $animalId)
                             ->first();
        if ($existing) {
            $animalName = $existing->animal->name ?? 'Animal';
            $existing->delete();
            $isFavourited = false;
            
            \App\Models\Activity::create([
                'user_id' => $user->id,
                'type' => 'favourite_remove',
                'description' => $user->name . ' removed ' . $animalName . ' from favourites.',
                'animal_id' => $animalId
            ]);
        } else {
            Favourite::create(['user_id' => $user->id, 'animal_id' => $animalId]);
            $isFavourited = true;
            
            $animal = Animal::find($animalId);
            \App\Models\Activity::create([
                'user_id' => $user->id,
                'type' => 'favourite_add',
                'description' => $user->name . ' added ' . ($animal->name ?? 'Animal') . ' to favourites.',
                'animal_id' => $animalId
            ]);
        }

        return response()->json([
            'favourited' => $isFavourited,
            'message' => $isFavourited ? 'Added to favourites!' : 'Removed from favourites'
        ]);
    }
}
