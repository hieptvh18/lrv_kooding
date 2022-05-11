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

        $data = DB::select('select sum(total_price) as doanhthu,date(updated_at) as ngay from orders where status = 2 and extract(year from "updated_at") = '.$year.' group by ngay ORDER BY ngay asc');

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


    // thong ke so lg hang hoa theo danh mu
    public function getQtyByCategory()
    {
        $data = DB::select('select count(products.id) as qty, categories.name as category_name from products left join categories on categories.id = products.category_id group by categories.name');

        if($data){
            return response()->json([
                'success'=>true,
                'message'=>'Get so luong hang hoa theo danh muc success',
                'data'=>$data
            ],200);
        }
        return response()->json([
            'success'=>false,
            'message'=>'Get so luong hang hoa theo danh muc fail',
            'data'=>[]
        ],200);
    }

    
}
