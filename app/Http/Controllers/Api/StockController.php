<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    //get all
    public function getByProductId($productId){
        return Stock::where('pro_id',$productId)->get();
    }
}
