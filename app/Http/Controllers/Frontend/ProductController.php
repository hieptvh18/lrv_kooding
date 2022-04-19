<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // trang cua hang(ds sarn pham)
    public function index(Request $request){
        // get data
        $pageTitle = 'Tất cả sản phẩm';
        $listProduct = Product::select('*');
        $keyCategory = $request->filter_cate;

        if($request->filter_cate){
            $categoryExist = Product::select('*')->where('category_id',$request->filter_cate)->get();
            if($categoryExist){
                $listProduct = $listProduct->where('category_id',$request->filter_cate);
            }
        }
        // option
        if($request->keyword){
            $pageTitle = 'Kết quả tìm kiếm: '."'".$request->keyword."'";
            $listProduct = $listProduct->where('name','like','%'.$request->keyword.'%');
        }
        $listProduct = $listProduct->where('status','!=',0)->orderBy('id','desc')->paginate(30);

        return view('client.shop.list',compact('listProduct','pageTitle'));
    }

    // page detail product
    public function show($slug){
        $product = Product::where('slug',$slug)->where('status','!=',0)->first();
        if($product){

            return view('client.shop.detail',compact('product'));
        }
        return redirect(route('404'));
    }
}
