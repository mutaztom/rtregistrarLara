<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/checkOrder/{orderid}',function(Request $request) {
   $result= OrderController::checkOrder($request->get('orderid'));
    return $result;
})->middleware('auth:sanctum');