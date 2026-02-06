<?php

use App\Models\Property; 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PropertyController;

Route::get('/', [App\Http\Controllers\PropertyController::class, 'index'])->name('home');

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
              ->orWhere('landmark', 'like', '%' . $request->search . '%');
    }

    // Filter by Type (Apartment, Land, etc)
     if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $properties = $query->latest()->paginate(9);
    return view('welcome', compact('properties'));
});
Route::middleware(['auth', 'verified_agent'])->group(function () {
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
// --- Admin Verification Section ---

Route::middleware(['auth'])->delete('/admin/users/{user}', [PropertyController::class, 'adminDestroyUser'])->name('admin.user.destroy');

// 1. This opens the page where you see unverified agents
Route::middleware(['auth'])->get('/admin/verify', [PropertyController::class, 'adminIndex'])->name('admin.verify');

// 2. This is the hidden instruction that runs when you click the "Approve" button
// PASTE THIS NEW LINE INSTEAD:
Route::middleware(['auth'])->post('/admin/toggle-user/{user}', [PropertyController::class, 'adminToggleUser'])->name('admin.user.toggle');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// Admin Property Monitor (To see all houses on the site)
Route::middleware(['auth'])->get('/admin/properties', [PropertyController::class, 'adminProperties'])->name('admin.properties');

// Admin Delete (To remove any house on the site)
Route::middleware(['auth'])->delete('/admin/properties/{property}', [PropertyController::class, 'adminDestroyProperty'])->name('admin.properties.destroy');
Route::get('/all-properties', [App\Http\Controllers\PropertyController::class, 'allProperties'])->name('properties.all');