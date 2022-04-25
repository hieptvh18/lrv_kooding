<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    //view cart
    public function cart()
    {
        return view('client.cart.cart');
    }

    // action add to cart(use session)
    public function addToCart(Request $request)
    {
        return $request->all();
    }
}
