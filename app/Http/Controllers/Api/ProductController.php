<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //get all
    public function getAll(){
         $products =Product::all();
        if($products){
            return response()->json([
                'success'=>true,
                'message'=>'Tất cả sản phẩm',
                'data'=>$products
            ]);
        }
        return response()->json([
            'success'=>false,
            'message'=>'Không tìm thấy sản phẩm trong kho',
            'data'=>[]
        ]);
    }

    // find one
    public function findOne($id){
        $product  = Product::find($id);

        if(is_null($product)){
            return response()->json([
                'success'=>false,
                'message'=>'Không tìm thấy sản phẩm trong kho',
                'data'=>[]
            ],200);
        }
        
        return $product;
    }
}
