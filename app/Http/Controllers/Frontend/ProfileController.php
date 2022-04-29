<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Http\Requests\Backend\UserRequest;

class ProfileController extends Controller
{
    //view profile client
    public function index()
    {
        // get orders
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        return view('client.pages.profile',compact('orders'));
    }

    // update profiel
    public function updateProfile(UserRequest $request)
    {
        
    }

    // change pass
    public function changePassword(Request $request)
    {

    }

    
}
