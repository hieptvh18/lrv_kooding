<?php

use Illuminate\Support\Facades\Route;

// client
use  App\Http\Controllers\Frontend\HomeController;

// auth
// use  App\Http\Controllers\Auth\LoginAdminController;
use Illuminate\Support\Facades\Auth;

// admin
use  App\Http\Controllers\Backend\DashboardController;
// =================ROUTE CLIENT===============
Route::get('/', [HomeController::class,'index'])->name('client.home');
Route::get('/trang-chu', [HomeController::class,'index'])->name('client.home');


// ===============ROUTE ADMIN===================
Route::prefix('admin')->group(function(){
    
    // dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard')->middleware('auth');

    // products
    Route::resource('product','App\Http\Controllers\Backend\ProductController')->middleware('auth');

     // attribute
     Route::resource('attribute','App\Http\Controllers\Backend\AttributeController')->only([
         'store','edit','update','destroy','index'
     ])->middleware('auth');

    //  attr value
     Route::resource('attributeValue','App\Http\Controllers\Backend\AttributeValueController')->only([
         'store','destroy'
     ])->middleware('auth');


});

// ================ajax================
    
Auth::routes();

