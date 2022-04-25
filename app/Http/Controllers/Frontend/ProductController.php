<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // trang cua hang(ds sarn pham)
    public function index(Request $request, $categorySlug = null)
    {
        // get data
        $pageTitle = 'Tất cả sản phẩm';
        $products = Product::select('products.*');
        $keyCategory = $request->filter_cate;

        // exist category-slug url
        if ($categorySlug) {
            $categoryExist = Category::where('slug', $categorySlug)->first();
            if ($categoryExist) {
                $pageTitle = "'".$categoryExist->name."'";
                $products = $products
                ->join('categories','products.category_id','categories.id')
                ->where('categories.slug', $categorySlug);
            }
        }

        // search with category id
        else if ($request->filter_cate) {
            if ($request->filter_cate != 'all') {
                $categoryExist = Product::select('*')->where('products.category_id', $request->filter_cate)->get();
                if ($categoryExist) {
                    $products = $products->where('products.category_id', $request->filter_cate);
                }
            }
        }

        // option search
        if ($request->keyword) {
            $pageTitle = 'Kết quả tìm kiếm: ' . "'" . $request->keyword . "'";
            $products = $products->where('products.name', 'like', '%' . $request->keyword . '%');
        }

        // filter price
        if($request->min_price && $request->max_price){
            
            $products = $products->whereBetween('price',[(int)$request->min_price,(int)$request->max_price]);
        }

        // get by category
        $products = $products->where('products.status','!=','0')->orderBy('products.id', 'desc')->paginate(20);
        // dd($products->lastPage());
        return view('client.shop.list', compact('products', 'pageTitle'));
    }

    //


    // page detail product
    public function show(Request $request, $slug,$id)
    {
        $product = Product::where('slug', $slug)->where('products.status','!=','0')->first();
        if ($product) {
            $product_id  = $product->id;

            return view('client.shop.detail', compact('product','product_id'));
        }
        return redirect(route('404'));
    }
}
