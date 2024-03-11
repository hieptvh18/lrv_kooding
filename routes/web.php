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
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ProfileController;

use App\Http\Controllers\Api\VnpayController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\CommentController as BackendCommentController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\WebSettingController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;

// check hạn sử dụng voucher + slg sản phẩm -> status
Route::middleware(['all.checkExpiry'])->group(function () {

    // =================auth======================

        // Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.loginForm')->middleware('firstAccess');

    // =================ROUTE CLIENT===============

    Route::get('/', [HomeController::class, 'index'])->name('client.home');
    Route::get('/trang-chu', [HomeController::class, 'index'])->name('client.home');

    // shops
    Route::prefix('cua-hang')->group(function () {
        Route::get('', [ProductClientController::class, 'index'])->name('client.shop');

        Route::get('/{slug}', [ProductClientController::class, 'index'])->name('client.shop.category');
        Route::get('/{slug}/{id}', [ProductClientController::class, 'show'])->name('client.shop.detail');

        // comment
        Route::post('/comment',[CommentController::class,'postComment'])->name('comment.post');
    });

    // cart
    Route::get('cart', [CartController::class, 'index'])->name('client.cart');
    // get data session cart
    Route::get('get-cart-session',[CartController::class,'getSessionCart']);
    Route::post('add-to-cart', [CartController::class, 'add'])->name('client.cart.add');
    Route::delete('remove-cart/{id}', [CartController::class, 'remove'])->name('client.cart.remove');
    Route::put('update-cart', [CartController::class, 'update'])->name('client.cart.update');

    // checkout
    Route::get('checkout', [CheckoutController::class, 'index'])->name('client.checkout')->middleware('checkerCheckout');
    Route::get('dat-hang-thanh-cong', [CheckoutController::class, 'resultCheckout'])->name('client.result-checkout')->middleware('auth');
    Route::post('checkout', [CheckoutController::class, 'postCheckout'])->name('client.handleCheckout');

    // profile
    Route::get('profile', [ProfileController::class, 'index'])->name('client.profile')->middleware('auth');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('client.updateProfile');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('client.changePassword');

    // social
    Route::get('/social', function () {
        return view('client.pages.album');
    })->name('client.social');

    Route::get('terms-of-use', function () {
        return view('client.pages.termsofuse');
    })->name('client.termsofuse');

    // news
    Route::get('blogs',[FrontendNewsController::class,'index'])->name('client.news');
    Route::get('blogs/{id}',[FrontendNewsController::class,'post'])->name('client.post');
    // vnpay
    // Route::get('payment_vnpay', [VnpayController::class, 'create'])->name('api.payment.vnpay');
    Route::get('return-vnpay', [VnpayController::class, 'return'])->name('api.payment.return-vnpay');

    Route::get('checkout/thanh-toan', [CheckoutController::class, 'handlePaymentVnpay'])->name('payment.handleSave');


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
            'index','store'
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
            'index', 'destroy', 'store', 'update','edit'
        ])->middleware(['auth.permission:admin']);

        // order
        Route::get('orders', [OrderController::class, 'index'])->name('admin.order.index');
        Route::get('orders/{id}', [OrderController::class, 'orderDetail'])->name('admin.order.detail');
        Route::put('change-status/{id}', [OrderController::class, 'changeStatus'])->name('admin.order.changeStatus');

        // news
        Route::resource('news', NewsController::class);

        // web setting
        Route::get('settings',[WebSettingController::class,'edit'])->name('websettings.edit');
        Route::put('settings',[WebSettingController::class,'update'])->name('websettings.update');

        // comment manage
        Route::get('comment',[BackendCommentController::class,'index'])->name('comment.index');
        Route::get('comment/list/{id}',[BackendCommentController::class,'detail'])->name('comment.detail');
        Route::delete('comment/delete',[BackendCommentController::class,'delete'])->name('comment.delete');

    });

    // ==============Export import file============
    Route::get('orders/export/', [OrderController::class, 'export'])->name('orders.export');
    Route::post('products/import/', [ProductController::class, 'import'])->name('products.import');
    Route::get('products/export/', [ProductController::class, 'export'])->name('products.export');

    // ================errors======================
    Route::get('403', function () {
        return view('errors.403');
    })->name('403');

    Route::get('404', function () {
        return view('errors.404');
    })->name('404');

    // route auth
    Auth::routes();
});
