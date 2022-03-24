<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;



class DashboardController extends Controller
{
    // mdư
    public function __construct()
    {
        // dd(Auth::user());
        // if(Auth::user()->role_id == 1){
        //     return redirect(route('client.home'));
        // }
    }
    // màn hình dashboard
    public function index(Request $request){
        // get data
        $currentLocation = $this->getLocation($request);
        return view('admin.dashboard.index',compact('currentLocation'));
    }

    // get current location admin
    public function getLocation(Request $request){
        // $ip = \Request::getClientIp(true); //ip khi post len host public
        $ip = '58.187.206.94';// ip khi dang phat trien o local
        $currentUserInfo = Location::get($ip);

        return $currentUserInfo;
    }

    
}
