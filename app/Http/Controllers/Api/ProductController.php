<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //get all
    public function getAll(){
        return Product::all();
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
