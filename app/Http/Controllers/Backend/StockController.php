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
        $productStocks = array();

        // check product exist in stock => render to display
        $productExist = Stock::where('pro_id',$id)->get();

        if($productExist){
            $productStocks = $productExist;
        }

        return view('admin.product.add-stock',compact('product','productStocks'));
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

        // check exist 
        $productExist = Stock::where('pro_id',$request->input('pro_id'))->get();
        if($productExist){
            foreach($productExist as $val){
                if($val->color_id == $request->input('color_id') && $val->size_id == $request->input('size_id') && $val->material_id == $request->input('material_id')){
                    // exist all attribute => += quantity
                    $stockModel = Stock::find($val->id);
    
                    $stockModel->pro_id = $request->input('pro_id');
                    $stockModel->quantity = $stockModel->quantity += $request->input('quantity');
            
                    $stockModel->save();
                    return redirect(route('stock.create',$request->input('pro_id')));

                }
            }
                // exist pro but not === attribute
                $stockModel = new Stock();

                $stockModel->fill($request->all());
        
                $stockModel->save();

        }else{
            // not exist product add new
            $stockModel = new Stock();
    
            $stockModel->fill($request->all());
    
            $stockModel->save();

        }


        return redirect(route('stock.create',$request->input('pro_id')));

    }

    // remove variant
    function destroyVariant($id){

        $stockExist = Stock::find($id);
        if($stockExist){
            Stock::destroy($id);            
            return redirect(route('stock.create',$stockExist->pro_id))->with('msg-suc','Xóa thành công sản phẩm trong kho!');
        }
        return back()->with('msg-er','Không tìm thấy sản phẩm trong kho!');
    }
   
}
