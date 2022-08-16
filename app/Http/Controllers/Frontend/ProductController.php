<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;

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
                $pageTitle = "'" . $categoryExist->name . "'";
                $products = $products
                    ->join('categories', 'products.category_id', 'categories.id')
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
        if ($request->min_price && $request->max_price) {

            $products = $products->whereBetween('price', [(int)$request->min_price, (int)$request->max_price]);
        }

        // get by category
        $products = $products->where('products.status', '!=', '0')->orderBy('products.id', 'desc')->paginate(20);

        return view('client.shop.list', compact('products', 'pageTitle'));
    }

    //


    // page detail product
    public function show(Request $request, $slug, $id)
    {
        $product = Product::where('slug', $slug)->where('products.status', '!=', '0')->first();
        if ($product) {

            // relate pro
            $relatePros = Product::where('category_id',$product->category_id)
                                    ->where('id','!=',$id)
                                    ->where('status','!=',0)->get();
            // increment view
            $product->increment('view',1);

            $product_id  = $product->id;

            $comments = Comment::select('*')
            ->with('user')
            ->where('product_id',$id)
            ->orderByDesc('id')
            ->limit(5)->get();
            return view('client.shop.detail', compact('product', 'product_id','relatePros','comments'));
        }
        return redirect(route('404'));
    }

    // show comment in detail page
    public function showComment()
    {

    }
}
