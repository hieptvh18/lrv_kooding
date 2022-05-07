<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\WebSetting;

class HomeController extends Controller
{
    //màn hình trang chủ
    public function index(){
        // get data
        $productsTopView = Product::where('status','!=',0)->orderBy('view','desc')->limit(20)->get();
        $productsNew = Product::where('status','!=',0)->orderBy('created_at','desc')->limit(20)->get();
        $categoryRandom = Category::inRandomOrder()->limit(4)->get();
        $categoryTop = Category::inRandomOrder()->limit(3)->get();
        $settings = WebSetting::first();

        return view('client.homepage.index',compact('productsTopView','productsNew','categoryRandom','categoryTop','settings'));
    }
}
