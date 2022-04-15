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
            // dd($product->stocks->toArray());

            // attrvalue trung lap -> lay 1 thuoc tinh
            for ($i=0; $i < count($product->stocks->toArray()); $i++) { 

                    // now items stock is array
                    $colorExist = $product->stocks->toArray()[$i]['color_id'];
                $sizeExist = $product->stocks->toArray()[$i]['size_id'];

                if($i  > 0){
                    // check item - 1 exist -> continue -> next 
                    if($sizeExist == $product->stocks->toArray()[$i]['size_id']){
                        continue;
                    }
                }

                // display attr
                // echo getAttributeValue($product->stocks->toArray()[$i]['size_id']);
                // echo getAttributeValue($product->stocks->toArray()[$i]['color_id']);
            }

            return view('client.shop.detail',compact('product'));
        }
        return redirect(route('404'));
    }
}
