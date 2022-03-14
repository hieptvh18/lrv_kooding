<?php

use Illuminate\Support\Facades\Route;

// client
use  App\Http\Controllers\Frontend\HomeController;

// use  App\Http\Controllers\Auth\LoginAdminController;
use Illuminate\Support\Facades\Auth;

// admin
use  App\Http\Controllers\Backend\DashboardController;
use  App\Http\Controllers\Backend\CategoryAttrbuteController;

// =================ROUTE CLIENT===============
Route::get('/', [HomeController::class,'index'])->name('client.home');
Route::get('/trang-chu', [HomeController::class,'index'])->name('client.home');


// ===============ROUTE ADMIN===================
Route::prefix('admin')->group(function(){
    
    
    // dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');

    // products
    
    Route::resource('product','App\Http\Controllers\Backend\ProductController');
    
    // categories
    Route::resource('categories','App\Http\Controllers\Backend\CategoryController');
    // remove category attribute
    Route::get('/category/delete/{attr_id}/{cate_id}',[CategoryAttrbuteController::class,'destroy'])->name('category-attribute.destroy');
    // add cate attr
    Route::post('/category/store/{cate_id}',[CategoryAttrbuteController::class,'store'])->name('category-attribute.store');

    

     // attribute
     Route::resource('attribute','App\Http\Controllers\Backend\AttributeController')->only([
         'store','edit','update','destroy','index'
     ]);

    //  attr value
     Route::resource('attributeValue','App\Http\Controllers\Backend\AttributeValueController')->only([
         'store','destroy'
     ]);


});

// ================ajax================
    
// Auth::routes();

