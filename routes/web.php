<?php

use Illuminate\Support\Facades\Route;

// client
use  App\Http\Controllers\Frontend\HomeController;

// use  App\Http\Controllers\Auth\LoginAdminController;
use Illuminate\Support\Facades\Auth;

// admin
use  App\Http\Controllers\Backend\DashboardController;
use  App\Http\Controllers\Backend\CategoryAttrbuteController;
use  App\Http\Controllers\Backend\StockController;
use  App\Http\Controllers\Backend\ProductController;

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

// =================ROUTE CLIENT===============
Route::get('/', [HomeController::class,'index'])->name('client.home');
Route::get('/trang-chu', [HomeController::class,'index'])->name('client.home');


// ===============ROUTE ADMIN===================

    Route::prefix('admin')->group(function(){
        
        
        // dashboard
        Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');

        // products
        Route::resource('product','App\Http\Controllers\Backend\ProductController');
        Route::delete('product-delete-muntiple',[ProductController::class,'removeMuntiple'])->name('product.removeMuntiple');
        
        // categories
        Route::resource('categories','App\Http\Controllers\Backend\CategoryController');
        // remove category attribute
        Route::get('/category/delete/{attr_id}/{cate_id}',[CategoryAttrbuteController::class,'destroy'])->name('category-attribute.destroy');
        // add cate attr
        Route::post('/category/store/{cate_id}',[CategoryAttrbuteController::class,'store'])->name('category-attribute.store');
        
        // brand
        Route::resource('brand','App\Http\Controllers\Backend\BrandController')->only([
            'store','destroy','index'
        ]);
        // attribute
        Route::resource('attribute','App\Http\Controllers\Backend\AttributeController')->only([
            'index'
        ]);

        //  attr value
        Route::resource('attributeValue','App\Http\Controllers\Backend\AttributeValueController')->only([
            'store','destroy'
        ]);

        //  stocks
        Route::get('stock-mangage',[StockController::class,'index'])->name('stock.index');
        Route::get('add-to-stock/{id}',[StockController::class,'create'])->name('stock.create');
        Route::post('store-to-stock',[StockController::class,'store'])->name('stock.store');
        Route::delete('remove-item-stock/{id}',[StockController::class,'destroyVariant'])->name('stock.destroyVariant');
        
        //   user
        Route::resource('user','App\Http\Controllers\Backend\UserController');


    });

// ================ajax================
    
Auth::routes();

