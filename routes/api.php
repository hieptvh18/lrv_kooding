<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Api\GoogleController;

use App\Http\Controllers\Api\AjaxController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// handle ajax request
Route::any('ajax/get-attr-value-exist',[AjaxController::class,'attrValueExist'])->name('ajax.attr-value-exist');
Route::any('ajax/get-attr-of-category',[AjaxController::class,'getAttrOfCategory'])->name('ajax.get-attr-of-category');


// // Google Sign In
// Route::get('/google',[GoogleController::class,'redirectToGoogle'])->name('login.google');
// Route::get('/google/callback',[GoogleController::class,'googleCallback'])->name('login.callback');
