<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // màn hình dashboard
    public function index(){
        // get data

        
        return view('admin.dashboard.index');
    }
}
