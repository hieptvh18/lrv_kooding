<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

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
        // handle add to cart
        $product = Product::find($request->pro_id)->toArray();
        $color = (int)$request->color;
        $size = (int)$request->size;
        $quantity = (int)$request->quantity;

       

    }
}
