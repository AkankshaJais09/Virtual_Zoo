<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use App\Models\Habitat;
use App\Models\Favourite;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display the Admin Dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_favourites' => Favourite::count(),
            'total_habitats' => Habitat::count(),
            'total_animals' => Animal::count(),
        ];

        // Most liked animals
        $popularAnimals = Animal::withCount('favouritedBy')
            ->orderBy('favourited_by_count', 'desc')
            ->limit(5)
            ->get();

        // Recently active users (recent registrations + active logs)
        $recentUsers = User::withCount('favourites')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Live interaction stream (recent activities)
        $activities = Activity::with(['user', 'animal'])
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'popularAnimals', 'recentUsers', 'activities'));
    }

    /**
     * Display the Users Management Page.
     */
    public function users(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $query = User::withCount('favourites')
            ->with(['activities' => function ($q) {
                $q->orderBy('created_at', 'desc')->limit(1);
            }]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($status) {
            if ($status === 'active') {
                // User has at least one activity log
                $query->whereHas('activities');
            } elseif ($status === 'inactive') {
                // User has no activity logs
                $query->whereDoesntHave('activities');
            }
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.users', compact('users', 'search', 'status'));
    }

    /**
     * Display the Favourites Analytics Page.
     */
    public function favourites()
    {
        // Favourites count per animal (all time leaderboard)
        $animalLeaderboard = Animal::withCount('favouritedBy')
            ->with('habitat')
            ->orderBy('favourited_by_count', 'desc')
            ->get();

        // Most popular habitats by favourite counts
        $habitatAnalytics = Habitat::join('animals', 'animals.habitat_id', '=', 'habitats.id')
            ->join('favourites', 'favourites.animal_id', '=', 'animals.id')
            ->select('habitats.id', 'habitats.name', DB::raw('count(favourites.id) as favourites_count'))
            ->groupBy('habitats.id', 'habitats.name')
            ->orderBy('favourites_count', 'desc')
            ->get();

        // Top trending animals (most recently favourited)
        $latestFavouriteAnimalIds = Favourite::orderBy('created_at', 'desc')
            ->pluck('animal_id')
            ->unique()
            ->take(4)
            ->toArray();

        $trendingAnimals = Animal::withCount('favouritedBy')
            ->whereIn('id', $latestFavouriteAnimalIds)
            ->get()
            ->sortBy(function ($animal) use ($latestFavouriteAnimalIds) {
                return array_search($animal->id, $latestFavouriteAnimalIds);
            })
            ->values();

        return view('admin.favourites', compact('animalLeaderboard', 'habitatAnalytics', 'trendingAnimals'));
    }

    /**
     * Display the Activity Log Page.
     */
    public function activity(Request $request)
    {
        $type = $request->input('type');

        $query = Activity::with(['user', 'animal']);

        if ($type) {
            $query->where('type', $type);
        }

        $activities = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.activity', compact('activities', 'type'));
    }
}
