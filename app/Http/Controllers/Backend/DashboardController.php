<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Product;


class DashboardController extends Controller
{

    public function __construct()
    {
        // dd(Auth::user());
        // if(Auth::user()->role_id == 1){
        //     return redirect(route('client.home'));
        // }
    }
    // màn hình dashboard
    public function index(Request $request)
    {
        // get location
        $currentLocation = $this->getLocation($request);

        // lay du lieu thong ke do ra bieu do
        $year = date('Y');

        if ($request->_year) {
            $year = $request->_year;
        }

        $totalOrder = Order::where(DB::raw('extract(year from "updated_at")'), $year)->count();
        $donChuaXuLi = Order::where(DB::raw('extract(year from "updated_at")'), $year)->where('status', 0)->count();
        $tongDoanhThuNam = DB::select('select sum(total_price) as dt from orders where extract(year from "updated_at")= ' . $year . ' group by extract(year from "updated_at")');
        $totalProduct = Product::count();

        // đơn bị hủy
        $cancel_order = Order::where(DB::raw('extract(year from "updated_at")'),$year)->where('status',3)->count();
        // số đơn hàng đang xử lí
        $processing_order = Order::where(DB::raw('extract(year from "updated_at")'),$year)->where('status',1)->count();
        // số đơn hàng đang xử lí
        $sent_order = Order::where(DB::raw('extract(year from "updated_at")'),$year)->where('status',2)->count();
        // số đơn hàng chưa xử lí
        $unprocess_order = Order::where(DB::raw('extract(year from "updated_at")'),$year)->where('status',0)->count();
        // đơn chờ xn

        return view('admin.dashboard.index', compact('currentLocation', 'totalOrder', 'donChuaXuLi', 'tongDoanhThuNam', 'totalProduct','cancel_order','processing_order','sent_order','unprocess_order'));
    }

    // get current location admin
    public function getLocation(Request $request)
    {
        // $ip = \Request::getClientIp(true); //ip khi post len host public
        $ip = '58.187.206.94'; // ip khi dang phat trien o local
        $currentUserInfo = Location::get($ip);

        return $currentUserInfo;
    }
}
