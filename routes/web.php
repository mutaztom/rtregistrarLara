<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegRequestController;
use App\Http\Controllers\QualcertController;
use App\Http\Controllers\UserAvatarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/regorder',[RegRequestController::class,"registerrequest"]
)->middleware(['auth', 'verified'])->name('regorder');


Route::post('/savequalification',[RegRequestController::class,"savequalification"]
)->middleware(['auth', 'verified'])->name('savequalification');

Route::post('/saveorder',[RegRequestController::class,"saveorder"]
)->middleware(['auth', 'verified'])->name('saveorder');

Route::get('/uploadphoto',[RegRequestController::class,"uploadphoto"]
)->middleware(['auth', 'verified'])->name('uploadphoto');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/avatar', function () {
//     return view('livewire.avatar');
// })->middleware(['auth', 'verified'])->name('avatar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Add a route that can load an image from storage based on a parameter
Route::get('/photos/{imageName}', [UserAvatarController::class,'show'])->name('show.avatar');
Route::get('/getcert/{qualid}', [QualcertController::class,'showcert'])->name('show.cert');
Route::get('/getcertfile/{qualid}', [QualcertController::class,'certfile'])->name('cert.file');
Route::get('/modifyqual/{qualid}', [QualcertController::class,'modify'])->name('modify.qual');
Route::get('/deletequal/{qualid}', [QualcertController::class,'delete'])->name('remove.qual');
Route::post('/removequalpdf/{qualid}', [QualcertController::class,'deletepdf'])->name('remove.qualpdf');

require __DIR__.'/auth.php';
