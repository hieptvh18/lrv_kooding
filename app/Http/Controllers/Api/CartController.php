<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    // get all data cart
    public function findByUser ($id)
    {
        return Cart::where('user_id',$id)->get();
    }
}
