<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistalController extends Controller
{
    //getDoangThuTungThang
    public function getDoangThuTungThang(Request $request)
    {
        $year = date('Y');

        if( $request->_year){
            $year = $request->_year;
        }

        $data = DB::select('select sum(total_price) as doanhthu,date(updated_at) as ngay from orders where status = 2 and year(updated_at) = '.$year.' group by ngay');

        if($data){
            return response()->json([
                'success'=>true,
                'message'=>'Get doanh thu theo tung thang success',
                'data'=>$data
            ],200);
        }
        return response()->json([
            'success'=>false,
            'message'=>'Get doanh thu theo tung thang fail',
            'data'=>[]
        ],200);

    }


    // 
}
