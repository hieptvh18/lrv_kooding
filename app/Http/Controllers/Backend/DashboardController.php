<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    public function index(){
        // get data

        return view('admin.dashboard.index');
    }
}
