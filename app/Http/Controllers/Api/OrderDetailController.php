<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Http\Resources\OrderDetailResource;

class OrderDetailController extends Controller
{
    // get order detail by order id
    public function getOrderDetailbyOrderId($id)
    {
        $orderDetail = OrderDetail::where('order_id', $id)->get();

        if (count($orderDetail) == 0) {
            $arr = array(
                "success" => false,
                'message' => "Không tìm thấy đơn hàng",
                'data' => []
            );
            return response()->json($arr, 200);
        }
        $arr = OrderDetailResource::collection($orderDetail);
        return response()->json($arr, 201);
    }
}
