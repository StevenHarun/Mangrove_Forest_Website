<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminRegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/home', [AdminRegistrationController::class, 'store']);

// Route::get('register', [RegisteredUserController::class, 'create'])
//             ->name('register');

// Route::post('register', [RegisteredUserController::class, 'store']);

require __DIR__.'/auth.php';
