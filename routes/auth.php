<?php

use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


// =================auth======================
Route::prefix('auth')->group(function(){

    Route::get('login',[LoginController::class,'showLoginForm'])->name('auth.loginForm');
});


// Google Sign In
Route::get('/google',[GoogleController::class,'redirectToGoogle'])->name('login.google');
Route::get('/google/callback',[GoogleController::class,'googleCallback'])->name('login.callback');
