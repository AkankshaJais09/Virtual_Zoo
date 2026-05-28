<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\FactsController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

// Protected Routes (Require Login to access anything)
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    Route::get('/explore/{habitat}', [ExploreController::class, 'show'])->name('explore.show');
    Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
    Route::get('/animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');
    Route::get('/visit', [VisitController::class, 'index'])->name('visit');
    Route::get('/facts', [FactsController::class, 'index'])->name('facts');

    Route::get('/about', function () {
        return redirect('/#footer');
    })->name('about');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Favourites
    Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites.index');
    Route::post('/favourites/toggle', [FavouriteController::class, 'toggle'])->name('favourites.toggle');
});

// Admin Panel Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/favourites', [AdminController::class, 'favourites'])->name('favourites');
    Route::get('/activity', [AdminController::class, 'activity'])->name('activity');
});

require __DIR__.'/auth.php';
