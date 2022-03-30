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
use App\Models\ProductImage;

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
        $avatarName = uniqid() . '-product' . time() . '.' . $request->avatar->extension();
        
        $productNew = new Product();
        $productNew ->fill($request->all());
        $productNew->avatar = $avatarName;
        $save = $productNew->save();
        
        if($save){
            
            // upload
            $request->file('avatar')->move(public_path('uploads'), $avatarName);
            
            // add & upload pro_img
            foreach($request->file('avatars') as $key=>$item){
                $imageDetailName = uniqid() . '-product-detail-'.$key. time() . '.' . $item->extension();
                $item->move(public_path('uploads'), $imageDetailName);
                $productImage = new ProductImage();
                $productImage->pro_id = $productNew->id;
                $productImage->url = $imageDetailName;
                $productImage->save();
            }

            // add stocks attr_value
            
        }

        // redirect sang add product variant to stock
        return redirect(route('stock.create',$productNew->id));
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
        // get dât
        $product = Product::find($id);
        $listBrand = Brand::all();
        $categories = Category::all()->toArray();
        $listSelectCategory = getChildCategories($categories);

        if($product){
            // get data


            return view('admin.product.edit',compact('product','listSelectCategory','listBrand'));
        }

        return back()->with('msg-er','Không tìm thấy sản phẩm!');

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
        // dd($request->all());
        // check avatars detail
        if($request->file('avatars') && count($request->file('avatars')) > 5){
            return back()->with('err-avatars','Không được tải lên quá 5 ảnh!');
        }

        $productNew =  Product::find($id);

        if($request->file('avatar')){
            $avatarName = uniqid() . '-product' . time() . '.' . $request->avatar->extension();
            // unlink img old
            if(file_exists(public_path('uploads/'.$productNew->avatar))){
                unlink(public_path('uploads/'.$productNew->avatar));
            }
        }else{
            $avatarName = $request->input('avatar');
        }
        
        $productNew ->fill($request->all());
        $productNew->avatar = $avatarName;
        $save = $productNew->save();
        
        if($save){
            
            // upload
            if($request->file('avatar')){
                $request->file('avatar')->move(public_path('uploads'), $avatarName);
            }     

            // add & upload pro_img
            if($request->file('avatars')){
                foreach($request->file('avatars') as $key=>$item){
                    $imageDetailName = uniqid() . '-product-detail-'.$key. time() . '.' . $item->extension();
                    $item->move(public_path('uploads'), $imageDetailName);

                    $productImage = ProductImage::where('pro_id',$id)->get();
                    foreach($productImage as $val){
                        $productImageItem = ProductImage::find($val->id);
                        // $productImage->pro_id = $productNew->id;
                        $productImageItem->url = $imageDetailName;
                        $productImageItem->save();
                    }
                }
            }
            return back()->with('msg-suc','Cập nhật thành công!');
        }

        // er
        return back()->with('msg-er','Cập nhật không thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if($product){
            $proImg = ProductImage::where('pro_id',$id)->get();
            // unlink avatar & avatar detail
            if(file_exists(public_path('uploads/'.$product->avatar))){
                unlink(public_path('uploads/'.$product->avatar));
            }

            if($proImg){
                foreach($proImg as $item){
                    
                    if(file_exists(public_path('uploads/'.$item->url))){
                        unlink(public_path('uploads/'.$item->url));
                    }
                }
            }
            
            Product::destroy($id);

            return redirect(route('product.index'))->with('msg-suc','Xóa thành công!');
        }

        return back()->with('msg-er','Xóa không thành công!');
    }
}
