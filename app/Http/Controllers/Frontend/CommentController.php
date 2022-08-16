<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    protected  $BAD_WORDS = array('shit','me','fuck','ba');


    // action comment
    public function postComment(CommentRequest $request)
    {
        // handle bad words
        $arrComment = explode(' ',$request->content);
        foreach($arrComment as $key=>$comment){
            if(in_array($comment, $this->BAD_WORDS)){
                $arrComment[$key] = '***';
            }
        }
        $stringComments = implode(' ',$arrComment);
        try{
            $comment = new Comment();

            $comment->user_id = Auth::user()->id;
            $comment->product_id = $request->product_id;
            $comment->content = $stringComments;

            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = 'comment-'. uniqid().'.'.$file->extension();

                $comment->image = $file->storeAs('uploads/comments',$fileName);
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
