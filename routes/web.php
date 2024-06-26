<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
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
});

Route::resource('events', EventController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

Route::get('/events/create', [EventController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('events.create');

Route::get('/events/{id}', [EventController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('events.show');

Route::get('/events/{id}/edit', [EventController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('events.edit');

require __DIR__.'/auth.php';
