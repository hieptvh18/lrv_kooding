<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\ProductRequest;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Stock;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // màn hình danh sách + phan trang
        $listProduct = Product::orderBy('id','desc')->paginate(5);
        // dd(Product::find(2)->brands);
        return view('admin.product.list', compact('listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get data
        $listBrand = Brand::all();
        $listAttr =  Attribute::all();
        $categories = Category::all()->toArray();
        $listSelectCategory = getChildCategories($categories);
        
        // $listAttrOfCategory = ;

        return view('admin.product.add',compact('listSelectCategory','listBrand','listAttr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // check avatars detail
        if(count($request->file('avatars')) > 5){
            return back()->with('err-avatars','Không được tải lên quá 5 ảnh!');
        }
        $fileName = uniqid() . '-product' . time() . '.' . $request->avatar->extension();
        
        $productNew = new Product();
        $productNew ->fill($request->all());
        $productNew->avatar = $fileName;
        $save = $productNew->save();

        if($save){

            // upload
            $request->file('avatar')->move(public_path('uploads'), $fileName);
            
            // add & upload pro_img


            // add stocks attr_value
            foreach($request->attr_value_id as $item){
                $stock  = new Stock();
                $stock->pro_id = $productNew->id;
                $stock->attr_value_id = $item;
                $stock->attr_value_id = $item;
                $stock->save();
            }
        }


        return redirect(route('products.create'))->with('msg-suc','Thêm thành công sản phẩm vào kho hàng!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $listAttr = Product::select('attributes.*')

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
