<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/regorder',[RegRequestController::class,"registerrequest"]
)->middleware(['auth', 'verified'])->name('regorder');

Route::post('/savequalification',[RegRequestController::class,"savequalification"]
)->middleware(['auth', 'verified'])->name('regorder');

Route::post('/saveorder',[RegRequestController::class,"saveorder"]
)->middleware(['auth', 'verified'])->name('regorder');

Route::get('/uploadphoto',[RegRequestController::class,"uploadphoto"]
)->middleware(['auth', 'verified'])->name('uploadphoto');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
