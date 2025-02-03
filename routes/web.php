<?php

use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
    Route::get('/tasks/{task}/failed_list', [TaskController::class, 'failedList'])->name('task.failed_list');

    Route::get('/import_places', [PlaceController::class, 'index'])->name('import_places.index');
    Route::post('/import_places', [PlaceController::class, 'store'])->name('import_places.store');

});

require __DIR__ . '/auth.php';
