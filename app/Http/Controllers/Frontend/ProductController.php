<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // trang cua hang(ds sarn pham)
    public function index(){
        // get data
        $listProduct = Product::select('*')->where('status','!=',0)->orderBy('id','desc')->paginate(30);

        return view('client.shop.list',compact('listProduct'));
    }

    // page detail product
    public function show($slug){
        $product = Product::where('slug',$slug)->where('status','!=',0)->first();
        return view('client.shop.detail',compact('product'));
    }
}
