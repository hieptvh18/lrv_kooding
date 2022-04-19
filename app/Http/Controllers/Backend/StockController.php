<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;

class StockController extends Controller
{
  
    public function index(Request $request)
    {
        // display manage stock
        $listProductStock = Stock::select('*');
        $stockItemId = null;
        
        // option: sort search bla bla...
        $type = 'asc';
        if($request->_sort){
            if($request->type == 'asc'){
                $listProduct = $listProductStock->orderBy($request->column,$request->type);
                $type = 'desc';
            }else{
                $listProduct = $listProductStock->orderBy($request->column,$request->type);
                $type = 'asc';
            }
        }

        // search
        $searchTitle = '';
        if($request->keyword_stock){
            $listProductStock = $listProductStock->where('name','like','%'.$request->keyword_stock.'%');
            $searchTitle = 'Kết quả tìm kiếm: '. "'".$request->keyword_stock."'";
        }

        $listProductStock = $listProductStock->paginate(10);

        return view('admin.stocks.index',compact('listProductStock','type','searchTitle','stockItemId'));

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

        return view('admin.stocks.add-stock',compact('product','productStocks'));
    }

    // save product variant-> stock
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            "color_id"=>"required",
            "size_id"=>"required",
            "material_id"=>"required",
            "quantity" => "required|min:1|regex:/^\d{1,11}$/"
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
    
                    $stockModel->quantity = $stockModel->quantity += $request->input('quantity');
                    
                    // update total qty of table product
                    Product::find($request->pro_id)->increment('quantity',$request->quantity);
            
                    $stockModel->save();
                    return redirect(route('stock.create',$request->input('pro_id')));

                }
            }
        }
            // not exist product add new // exist pro but not === attribute
            $stockModel = new Stock();
    
            $stockModel->fill($request->all());
            // add qty to table product(all qty of variants)
            Product::find($request->pro_id)->increment('quantity',$request->quantity);
    
            $stockModel->save();

        return redirect(route('stock.create',$request->input('pro_id')));

    }

    // update all quantity(restock)
    public function updateAll(Request $request){
       
        // gom mang stock va update theo quantity(lap 2 mang check key==key)
        foreach($request->stock_id as $keyStock=>$valStock){
            foreach($request->new_quantity as $keyQty=>$valQty){
                if($keyStock == $keyQty){
                 
                    // update theo id (valStock) cua mang do theo valQTy 
                    Stock::find($valStock)->increment('quantity',$valQty);

                    // update total qty of table product
                    $stockItem = Stock::find($valStock);
                    Product::find($stockItem->pro_id)->increment('quantity',$valQty);
                }
            }
        }

        return back()->with('msg-suc','Cập nhật thành công kho!');
    }

    // remove variant product
    function destroyVariant($id){

        $stockExist = Stock::find($id);
        if($stockExist){

            // decrement quantity of variant in table products
            Product::find($stockExist->pro_id)->decrement('quantity',$stockExist->quantity);

            Stock::destroy($id);            
            return back()->with('msg-suc','Xóa thành công sản phẩm trong kho!');
        }
        return back()->with('msg-er','Không tìm thấy sản phẩm trong kho!');
    }
   
}
