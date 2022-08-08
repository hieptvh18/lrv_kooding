<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // show comment
    public function index()
    {

    }

    // action comment
    public function postComment(CommentRequest $request)
    {
        try{
            $comment = new Comment();

            $comment->user_id = Auth::user()->id;
            $comment->product_id = $request->product_id;
            $comment->content = $request->content;

            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = $file->hasName();

                $comment->image = $file->storeAs('uploads/comments/',$fileName);
                
            }

            $comment->save();

            return redirect()->back()->with('msg-suc','Đã bình luận!');

        }catch(\Throwable $e){
            report($e);
            return false;
        }
    }

    // action remove comment

    public function removeComment($id)
    {

    }
}
