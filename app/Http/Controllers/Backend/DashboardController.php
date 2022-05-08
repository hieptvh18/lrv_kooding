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
    public function index(Request $request){
        // get location
        $currentLocation = $this->getLocation($request);

        // lay du lieu thong ke do ra bieu do
        $year = date('Y');

        if( $request->_year){
            $year = $request->_year;
        }
        $doanhThuThang = DB::select('select sum(total_price) as doanhthu,month(updated_at) as thang,year(updated_at) as nam from orders where status = 2 and year(updated_at) = '.$year.' group by thang,nam') ;

        $totalOrder = Order::where(DB::raw('year(updated_at)'),$year)->count();
        $donChuaXuLi = Order::where(DB::raw('year(updated_at)'),$year)->where('status',0)->count();
        $tongDoanhThuNam= DB::select('select sum(total_price) as dt from orders where year(updated_at)= '.$year.' group by year(updated_at)');
        $totalProduct = Product::count();

        return view('admin.dashboard.index',compact('currentLocation','doanhThuThang','totalOrder','donChuaXuLi','tongDoanhThuNam','totalProduct'));
    }

    // get current location admin
    public function getLocation(Request $request){
        // $ip = \Request::getClientIp(true); //ip khi post len host public
        $ip = '58.187.206.94';// ip khi dang phat trien o local
        $currentUserInfo = Location::get($ip);

        return $currentUserInfo;
    }

    
}
