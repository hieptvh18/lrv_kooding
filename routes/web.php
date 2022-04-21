<?php

use Illuminate\Support\Facades\Route;

// client
use  App\Http\Controllers\Frontend\HomeController;
use  App\Http\Controllers\Frontend\ProductController as ProductClientController;

// use  App\Http\Controllers\Auth\LoginAdminController;
use Illuminate\Support\Facades\Auth;

// admin
use  App\Http\Controllers\Backend\DashboardController;
use  App\Http\Controllers\Backend\CategoryAttrbuteController;
use  App\Http\Controllers\Backend\StockController;
use  App\Http\Controllers\Backend\ProductController;
use  App\Http\Controllers\Backend\VoucherController;

use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backend\UserController;

// check hạn sử dụng voucher + slg sản phẩm -> status
Route::middleware(['all.checkExpiry'])->group(function () {

    // =================auth======================
    Route::prefix('auth')->group(function () {

        Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.loginForm');
    });


    // Google Sign In

    // =================ROUTE CLIENT===============

    Route::get('/', [HomeController::class, 'index'])->name('client.home');
    Route::get('/trang-chu', [HomeController::class, 'index'])->name('client.home');

    // shops
    Route::prefix('cua-hang')->group(function () {
        Route::get('', [ProductClientController::class, 'index'])->name('client.shop');

        Route::get('/{slug}', [ProductClientController::class, 'index'])->name('client.shop.category');
        Route::get('/{slug}/{id}', [ProductClientController::class, 'show'])->name('client.shop.detail');
    });

    // social
    Route::get('/social',function(){
        return view('client.pages.album');
    })->name('client.social');


    // ===============ROUTE ADMIN===================

    Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {

        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // products
        Route::resource('product', 'App\Http\Controllers\Backend\ProductController');
        Route::delete('product-delete-muntiple', [ProductController::class, 'removeMuntiple'])->name('product.removeMuntiple');

        // categories
        Route::resource('categories', 'App\Http\Controllers\Backend\CategoryController');
        // remove category attribute
        Route::get('/category/delete/{attr_id}/{cate_id}', [CategoryAttrbuteController::class, 'destroy'])->name('category-attribute.destroy');
        // add cate attr
        Route::post('/category/store/{cate_id}', [CategoryAttrbuteController::class, 'store'])->name('category-attribute.store');

        // brand
        Route::resource('brand', 'App\Http\Controllers\Backend\BrandController')->only([
            'store', 'destroy', 'index'
        ]);
        // attribute
        Route::resource('attribute', 'App\Http\Controllers\Backend\AttributeController')->only([
            'index'
        ]);

        //  attr value
        Route::resource('attributeValue', 'App\Http\Controllers\Backend\AttributeValueController')->only([
            'store', 'destroy'
        ]);

        //  stocks
        Route::get('stock-manage', [StockController::class, 'index'])->name('stock.index');
        Route::get('add-to-stock/{id}', [StockController::class, 'create'])->name('stock.create');
        Route::post('store-to-stock', [StockController::class, 'store'])->name('stock.store');
        Route::delete('remove-item-stock/{id}', [StockController::class, 'destroyVariant'])->name('stock.destroyVariant');
        Route::put('store-update-quantity', [StockController::class, 'updateAll'])->name('stock.updateAll');

        //   user

        Route::resource('user', 'App\Http\Controllers\Backend\UserController')->middleware(['auth.permission:admin']);
        Route::get('profile', [UserController::class, 'profileDisplay'])->name('admin.profile');
        Route::post('save-profile', [UserController::class, 'profileStore'])->name('admin.profile.store');

        // voucher
        Route::resource('voucher', VoucherController::class)->only([
            'index', 'destroy', 'store', 'update'
        ])->middleware(['auth.permission:admin']);
    });

    // ================errors================
    Route::get('403', function () {
        return view('errors.403');
    })->name('403');

    Route::get('404', function () {
        return view('errors.404');
    })->name('404');

    // route auth
    Auth::routes();
});
