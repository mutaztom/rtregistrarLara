<?php

use App\Http\Controllers\Admin\AdmindashboardController;
use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\AdminSessionAuthenticator;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QualcertController;
use App\Http\Controllers\RegRequestController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserAvatarController;
use App\Http\Controllers\UserManagerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/regorder', [RegRequestController::class, 'registerrequest']
)->middleware(['auth', 'verified'])->name('regorder');

Route::post('/savequalification', [RegRequestController::class, 'savequalification']
)->middleware(['auth', 'verified'])->name('savequalification');

Route::post('/saveorder', [RegRequestController::class, 'saveorder']
)->middleware(['auth', 'verified'])->name('saveorder');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/stafflogin', [AdminSessionAuthenticator::class, 'getLogin'])->name('staff.login');
Route::post('/stafflogin', [AdminSessionAuthenticator::class, 'postLogin'])->name('staff.login.post');
Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox');
    Route::get('/settings', [SettingsController::class, 'create'])->name('settings');
    Route::patch('/updatesettings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/deletesettings', [SettingsController::class, 'delete'])->name('settings.delete');
    Route::patch('/updatefee', [SettingsController::class, 'modifyFee'])->name('fees.update');
    Route::patch('/deletefee', [SettingsController::class, 'deleteFee'])->name('fees.delete');
    Route::get('/viewregrequest/{orderid}', [OrderController::class, 'index'])->name('regrequest.view');
    Route::patch('/deleteregrequest', [InboxController::class, 'destroy'])->name('regrequest.delete');
    Route::patch('/modifyregrequest', [OrderController::class, 'modifyOrder'])->name('regrequest.modify');
    Route::get('/admindashboard', [AdmindashboardController::class, 'index'])->name('admin.dashboard');
    //admin manipuation for orders
    Route::patch('/rejectorder', [OrderController::class, 'rejectOrder'])->name('order.reject');
    Route::get('/inspectorder/{orderid}', [OrderController::class, 'inspectOrder'])->name('order.inspect');
    Route::post('/orderpay/{orderid}', [OrderController::class, 'payOrder'])->name('order.pay');
    Route::patch('/registrantmail', [OrderController::class, 'mailRegistrant'])->name('registrant.mail');
    Route::get('/saveapproval/{orderid}', [ApprovalController::class, 'create'])->name('order.approve');
    Route::patch('/saveapproval/{orderid}', [ApprovalController::class, 'store'])->name('approval.save');
    Route::get('/usermanager', [UserManagerController::class, 'index'])->name('usermanager');
    Route::post('/usermanager', [UserManagerController::class, 'create'])->name('user.create');
    Route::post('/edituser', [UserManagerController::class, 'edit'])->name('user.edit');
    Route::post('/updatepassword', [UserManagerController::class, 'updatePassword'])->name('user.updatepassword');
    Route::patch('/deleteuser', [UserManagerController::class, 'destroy'])->name('user.destroy');
    Route::patch('/userphoto', [UserManagerController::class, 'updatePhoto'])->name('user.photo');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/reginfo', [ProfileController::class, 'updatereginfo'])->name('reginfo.update');
    Route::get('/profile/{regid}', 'App\Http\Controllers\ProfileController@viewProfile')->name('profile.view');
    Route::patch('/uploadphoto', 'App\Http\Controllers\UserAvatarController@uploadphoto')->name('avatar.edit');
    Route::get('/myorders', 'App\Http\Controllers\RegRequestController@orderList')->name('order.list');
    Route::get('/modifyorder/{orderid}', 'App\Http\Controllers\RegRequestController@modifyOrder')->name('order.modify');
    Route::patch('/deleteorder/{orderid}', 'App\Http\Controllers\RegRequestController@destroy')->name('order.delete');
});
// Add a route that can load an image from storage based on a parameter
Route::get('/photos/{imageName}', [UserAvatarController::class, 'show'])->name('show.avatar');
Route::get('/getcert/{qualid}', [QualcertController::class, 'showcert'])->name('show.cert');
Route::get('/getcertfile/{qualid}', [QualcertController::class, 'certfile'])->name('cert.file');
Route::patch('/qualifications', [QualcertController::class, 'index'])->name('qual.index');
Route::get('/qualifications/{qualid}', [QualcertController::class, 'show'])->name('qual.show');
Route::patch('/modifyqual', [QualcertController::class, 'editQualification'])->name('modify.qual');
Route::get('/deletequal/{qualid}', [QualcertController::class, 'delete'])->name('remove.qual');
Route::post('/removequalpdf/{qualid}', [QualcertController::class, 'deletepdf'])->name('remove.qualpdf');
Route::post('/removemembership/{mid}', [MembershipController::class, 'destroy'])->name('remove.membership');

require __DIR__.'/auth.php';
