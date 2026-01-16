<?php

use App\Models\Property; 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PropertyController;

Route::get('/', function () {
    $properties = Property::latest()->get(); // This gets all houses from the DB
    return view('welcome', compact('properties')); // This sends them to the page
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/', function (Request $request) {
    $query = Property::query();

    // Filter by Search (Title or Landmark)
    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('landmark', 'like', '%' . $request->search . '%')
              ->orWhere('city', 'like', '%' . $request->search . '%');
    }

    // Filter by Type (Apartment, Land, etc)
    if ($request->has('type') && $request->type != '') {
        $query->where('type', $request->type);
    }

    $properties = $query->latest()->get();
    
    return view('welcome', compact('properties'));
});
Route::middleware(['auth'])->group(function () {
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    
    // New Routes for Management
    Route::get('/my-listings', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
});

require __DIR__.'/auth.php';

Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
