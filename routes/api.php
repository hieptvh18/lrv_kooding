<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\FacebookController;

use App\Http\Controllers\Api\AjaxController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// handle ajax request
Route::any('ajax/get-attr-value-exist',[AjaxController::class,'attrValueExist'])->name('ajax.attr-value-exist');
Route::any('ajax/get-attr-of-category',[AjaxController::class,'getAttrOfCategory'])->name('ajax.get-attr-of-category');


// // Google Sign In
Route::get('/google',[GoogleController::class,'redirectToGoogle'])->name('login.google');
Route::get('/google/callback',[GoogleController::class,'googleCallback'])->name('login.callback');

// login fb
Route::get('/facebook',[FacebookController::class,'redirectToFacebookLogin'])->name('login.facebook');
Route::get('/facebook/callback',[FacebookController::class,'facebookCallback'])->name('login.facebook.callback');

// check exist vouvher
Route::any('ajax/voucher-exist',[AjaxController::class,'voucherExist'])->name('ajax.voucherExist');
