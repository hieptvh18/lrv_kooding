<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    // show 1 order
    public function show($id)
    {
        $order = Order::find($id);
        if(!$order){
            return response()->json([
                'success'=>false,
                'message'=>'Không tìm thấy đơn hàng',
                'data'=>[]
            ],201);
        }
        $arr = [
            'success'=>true,
                'message'=>'Không tìm thấy đơn hàng',
                'data'=> new OrderResource($order)
        ];

        return response()->json($arr,201);
    }
}
