<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/videos/{video}/request', [VideoRequestController::class, 'requestAccess'])->name('videos.request');
    Route::get('/dashboard/{video}', [DashboardController::class, 'show'])->name('dashboard.show');

    //admin middleware
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('videos', VideoController::class);
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::get('/video-requests', [VideoRequestController::class, 'index'])->name('video_requests.index');
        Route::post('/video-requests/{request}/approve', [VideoRequestController::class, 'approveAccess'])->name('video_requests.approve');
    });
});

require __DIR__ . '/auth.php';
