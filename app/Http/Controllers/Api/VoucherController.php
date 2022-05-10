<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    //get all

    public function index()
    {
        return Voucher::all();
    }

    // update
    public function update(Request $request, $id)
    {
        $voucher = Voucher::find($id);
        if ($voucher) {
            $arr = [
                'success' => 'fail',
                'message' => 'Update voucher fail',
                'data' => []
            ];
            return response()->json($arr, 200);
        }

        $voucher->update($request->all());

        $arr = [
            'success' => 'fail',
            'message' => 'Update voucher fail',
            'data' => $voucher
        ];
        return response()->json($arr, 200);
    }
}
