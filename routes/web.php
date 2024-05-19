<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ReturnController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/car', [CarController::class, 'index'])->name('car');
    Route::post('/car', [CarController::class, 'store'])->name('car.store');
    Route::get('/car/{id}', [CarController::class, 'edit'])->name('car.edit');
    Route::patch('/car/{id}', [CarController::class, 'update'])->name('car.update');
    Route::delete('/car/{id}', [CarController::class, 'destroy'])->name('car.destroy');

    Route::get('/rental', [RentalController::class, 'index'])->name('rental');
    Route::post('/rental', [RentalController::class, 'store'])->name('rental.store');

    Route::get('/return', [ReturnController::class, 'index'])->name('return');
    Route::get('/return/{rentalId}', [ReturnController::class, 'create'])->name('return.create');
    Route::post('/return', [ReturnController::class, 'store'])->name('return.store');
    Route::get('/return/{id}/show', [ReturnController::class, 'show'])->name('return.show');
});

require __DIR__.'/auth.php';
