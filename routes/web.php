<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Enums\PermissionEnum;
use App\Http\Controllers\Auth\GoogleController;


// Google OAuth routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/dashboard-stats', [App\Http\Controllers\DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::post('/api/dashboard-broadcast', [App\Http\Controllers\DashboardController::class, 'broadcastStats'])->name('dashboard.broadcast');
});

Route::resource('users', UserController::class)->middleware('can:'.PermissionEnum::MANAGE_USERS->value);
Route::resource('clients', ClientController::class);
Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
require __DIR__.'/auth.php';
