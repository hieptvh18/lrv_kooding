<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    //get all
    public function getByProductId($productId){
        $stock = Stock::where('pro_id',$productId)->get();

        if(count($stock) == 0){
            return response()->json([
                'success'=>false,
                'message'=>'Không tìm thấy biến thể sản phẩm trong kho',
                'data'=>[]
            ],200);
        }
        
        return $stock;
    }   
}
