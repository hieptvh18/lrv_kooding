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

        // get by category
        $products = $products->orderBy('products.id', 'desc')->paginate(20);
        // dd($products->lastPage());
        return view('client.shop.list', compact('products', 'pageTitle'));
    }

    //


    // page detail product
    public function show(Request $request, $slug,$id)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {

            return view('client.shop.detail', compact('product'));
        }
        return redirect(route('404'));
    }
}
