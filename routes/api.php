<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\FacebookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\ProductController;

use App\Http\Controllers\Api\AjaxController;
use App\Http\Controllers\Api\AttributeValueController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderDetailController;
use App\Http\Controllers\Api\StatistalController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\VnpayController;
use App\Http\Controllers\Backend\DashboardController;
use App\Models\Role;
use App\Models\Stock;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// handle ajax request
Route::any('ajax/get-attr-value-exist',[AjaxController::class,'attrValueExist'])->name('ajax.attr-value-exist');
Route::any('ajax/get-attr-of-category',[AjaxController::class,'getAttrOfCategory'])->name('ajax.get-attr-of-category');
Route::any('ajax/get-child-category-by-parent-id',[AjaxController::class,'getChildCategoryByParentId'])->name('ajax.getChildCategoryByParentId');
Route::post('ajax/change-status-product',[AjaxController::class,'changeStatusProduct'])->name('ajax.changeStatusProduct');


// // Google Sign In
Route::get('/google',[GoogleController::class,'redirectToGoogle'])->name('login.google');
Route::get('/google/callback',[GoogleController::class,'googleCallback'])->name('login.callback');

// login fb
Route::get('/facebook',[FacebookController::class,'redirectToFacebookLogin'])->name('login.facebook');
Route::get('/facebook/callback',[FacebookController::class,'facebookCallback'])->name('login.facebook.callback');

// check exist vouvher
Route::any('ajax/voucher-exist',[AjaxController::class,'voucherExist'])->name('ajax.voucherExist');

// categories 
Route::get('categories',[CategoryController::class,'index'])->name('api.category');
// vouchers 
Route::get('vouchers',[VoucherController::class,'index'])->name('api.voucher.index');
// products
Route::get('product/{id}',[ProductController::class,'findOne'])->name('api.product.findOne');
// stock
Route::get('stocks/{productId}',[StockController::class,'getByProductId'])->name('api.stock.all');
// cart
Route::get('get-cart-user/{userId}',[CartController::class,'findByUser'])->name('api.cart.findByUser');
Route::get('get-cart-session',[CartController::class,'getSessionCart'])->name('api.cart.getSessionCart');

// render geography checkout
Route::post('get-geography',[AjaxController::class,'renderGeography'])->name('api.renderGeography');

// paypal
Route::get('create-transaction-paypal', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction-paypal', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction-paypal', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction-paypal', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

// vnpay
Route::get('payment_vnpay', [VnpayController::class, 'create'])->name('api.payment.vnpay');
Route::get('return-vnpay', [VnpayController::class, 'return'])->name('api.payment.return-vnpay');

// order detail
Route::get('order-detail/{id}',[OrderDetailController::class,'getOrderDetailByOrderId']);
// order
Route::get('order/{id}',[OrderController::class,'show']);

// attr value
Route::get('attribute-value/{id}',[AttributeValueController::class,'findOne']);

// so lieu thong ke (dashboard)
Route::get('get-doanh-thu-tung-thang-trong-nam',[StatistalController::class,'getDoangThuTungThang']);






