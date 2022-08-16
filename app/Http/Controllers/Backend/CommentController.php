<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    //list
    public function index()
    {

        $productComments = DB::table('products')
        ->join('comments','comments.product_id','products.id')
        ->select('products.id','products.name',DB::raw('MIN(comments.created_at) as cmt_old'),DB::raw('MAX(comments.created_at) as cmt_new'),DB::raw('count(comments.id) as qty'))
        ->groupBy('products.id','products.name')
        ->paginate(15);


        return view('admin.comments.index',compact('productComments'));
    }

    // detail
    public function detail(Request $request,$productId)
    {
        // get comment from product

        $comments = Comment::where('product_id',$productId)
        ->with('user')
        ->get();

        return view('admin.comments.detail',compact('comments'));
    }

    // delete
    public function delete(Request $request)
    {
        try{
            if(is_array($request->cmt_id)){
                DB::table('comments')->whereIn('id', $request->cmt_id)->delete();
                return redirect()->back()->with('msg-suc','Xóa thành công bình luận!');
            }
            Comment::destroy($cmt_id);
            return redirect()->back()->with('msg-suc','Xóa thành công bình luận!');

        }catch(\Throwable $e){
            report($e);
            return false;
        }
    }
}
