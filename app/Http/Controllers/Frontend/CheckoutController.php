<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

class CheckoutController extends Controller
{
    public function __construct(Request $request)
    {
    
    }

    // display checkout
    public function index(){
        
        if(!session('carts') || count(session('carts')) == 0){
            return redirect(route('client.home'));
        }

        // get data
        $provinces = Province::all();


        return view('client.cart.checkout',compact('provinces'));
    }

    // handle checkout
    public function handleCheckout(Request $request)
    {
        // ktra voucher


        // ktra thanh toan bang paypal
        
    }
}
