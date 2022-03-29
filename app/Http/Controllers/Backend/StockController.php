<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;

class StockController extends Controller
{
  
    public function index()
    {
        //

    }
    
    public function create($id)
    {
        // get id product
        $product = Product::find($id);
        $productAttribute = array();

        // check product exist in stock => render to display
        $productExist = Stock::where('pro_id',$id)->get();

        if($productExist){
            $productAttribute = $productExist;
            dd($productAttribute);
        }

        return view('admin.product.add-stock',compact('product','productAttribute'));
    }

    // save product variant-> stock
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            "color_id"=>"required",
            "size_id"=>"required",
            "material_id"=>"required",
            "quantity" => "required|regex:/^\d{1,11}$/"
        ],[
            "required"=>"Không được để trống"
        ]);

        $stockModel = new Stock();

        $stockModel->fill($request->all());

        $stockModel->save();

        return redirect(route('stock.create',$request->input('pro_id')));

    }
   
}
