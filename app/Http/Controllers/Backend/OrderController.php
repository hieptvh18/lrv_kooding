<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // list order
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.list',compact('orders'));
    }
}
