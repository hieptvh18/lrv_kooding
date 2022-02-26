<?php

use Illuminate\Support\Facades\Route;

// client
use  App\Http\Controllers\Frontend\HomeController;

// auth
use  App\Http\Controllers\Auth\LoginAdminController;

// =================ROUTE CLIENT===============
Route::get('/', [HomeController::class,'index']);

// ================== ROUTE AUTH===============
Route::get('admin', [LoginAdminController::class,'login'])->name('login.display');
Route::post('admin', [LoginAdminController::class,'postLogin'])->name('login.handle');


// ===============ROUTE ADMIN===================
