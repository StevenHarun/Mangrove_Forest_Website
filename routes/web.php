<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminRegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\ReportsController;
use App\Http\Middleware\CheckUserRole;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
    Route::get('/locations', [HomeController::class, 'locations'])->middleware('auth')->name('locations');
    
    Route::get('/locations/spot', [HomeController::class, 'spot'])->middleware('auth')->name('spot');
    Route::get('/locations/spot/create', [SpotController::class, 'create'])->middleware('auth')->name('spot.create');
    Route::get('/locations/spot/details/{param}', [SpotController::class, 'details'])->middleware('auth')->name('spot.details');
    Route::patch('/locations/spot/{id}', [SpotController::class, 'update'])->middleware('auth')->name('spot.update');
    Route::delete('/locations/spot/{id}', [SpotController::class, 'destroy'])->middleware('auth')->name('spot.destroy');
    
    Route::get('/locations/year', [HomeController::class, 'year'])->middleware('auth')->name('year');
    Route::get('/locations/year/create', [YearController::class, 'create'])->middleware('auth')->name('year.create');
    Route::get('/locations/year/details/{id}', [YearController::class, 'details'])->middleware('auth')->name('year.details');
    Route::patch('/locations/year/{id}', [YearController::class, 'update'])->middleware('auth')->name('year.update');
    Route::delete('/locations/year/{id}', [YearController::class, 'destroy'])->middleware('auth')->name('year.destroy');
    
    Route::get('/locations/map-year/{id}', [HomeController::class, 'map_year'])->middleware('auth')->name('map_year');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/home', [AdminRegistrationController::class, 'store']);
Route::post('/spot/create', [SpotController::class, 'store'])->name('spot.store');
Route::post('/year/create', [YearController::class, 'store'])->name('year.store');

Route::get('/reports/{reportId}/image', [ReportsController::class, 'retrieveImage'])->name('reports.image');
Route::delete('/report/{id}', [ReportsController::class, 'destroy'])->middleware('auth')->name('report.destroy');

// Route::middleware(['auth', 'role:user,pemda'])->group(function () {
//     Route::get('/report', [ReportsController::class, 'create'])->name('report.create');
//     Route::post('/report', [ReportsController::class, 'store'])->name('report.store');
//     Route::get('/viewreport', [ReportsController::class, 'viewReport'])->name('viewreport');
// });


// Tambahkan rute untuk filter
Route::get('/reports/filter/{category}', [ReportsController::class, 'filter'])->name('filter');

require __DIR__.'/auth.php';
