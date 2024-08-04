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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('/inbox',[InboxController::class, 'index'])->name('inbox');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/reginfo', [ProfileController::class, 'updatereginfo'])->name('reginfo.update');
    Route::patch('/uploadphoto', 'App\Http\Controllers\UserAvatarController@uploadphoto')->name('avatar.edit');
    Route::get('/myorders', 'App\Http\Controllers\RegRequestController@orderList')->name('order.list');
    Route::get('/modifyorder/{orderid}', 'App\Http\Controllers\RegRequestController@modifyOrder')->name('order.modify');
    Route::patch('/deleteorder/{orderid}', 'App\Http\Controllers\RegRequestController@destroy')->name('order.delete');
    
});
// Add a route that can load an image from storage based on a parameter
Route::get('/photos/{imageName}', [UserAvatarController::class,'show'])->name('show.avatar');
Route::get('/getcert/{qualid}', [QualcertController::class,'showcert'])->name('show.cert');
Route::get('/getcertfile/{qualid}', [QualcertController::class,'certfile'])->name('cert.file');
Route::patch('/qualifications', [QualcertController::class,'index'])->name('qual.index');
Route::get('/qualifications/{qualid}', [QualcertController::class,'show'])->name('qual.show');
Route::patch('/modifyqual', [QualcertController::class,'editQualification'])->name('modify.qual');
Route::get('/deletequal/{qualid}', [QualcertController::class,'delete'])->name('remove.qual');
Route::post('/removequalpdf/{qualid}', [QualcertController::class,'deletepdf'])->name('remove.qualpdf');
Route::post('/removemembership/{mid}', [MembershipController::class,'destroy'])->name('remove.membership');

require __DIR__.'/auth.php';
