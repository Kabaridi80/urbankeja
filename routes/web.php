<?php

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC ROUTES ---
Route::get('/', [PropertyController::class, 'allProperties'])->name('home');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
Route::view('/terms', 'terms')->name('terms');
Route::view('/agent-portal', 'agent-portal')->name('agent.portal');

// --- AUTH PROTECTED ROUTES ---
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Agent Actions
    Route::get('/my-listings', [PropertyController::class, 'myListings'])->name('properties.index');
    Route::get('/list-property', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');

    // Admin Actions
    Route::get('/admin/agents', [AdminController::class, 'index'])->name('admin.agents');
    Route::patch('/admin/agents/{id}/verify', [AdminController::class, 'verify'])->name('admin.agents.verify');
    Route::delete('/admin/agents/{id}', [AdminController::class, 'destroy'])->name('admin.agents.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';