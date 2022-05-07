<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // danh sasch tin tuc

    public function index()
    {
        // all tin
        $blogs = News::all();

        // new post
        $newPosts = News::OrderBy('created_at','desc')->limit(4)->get();

        return view('client.blogs.blogs',compact('blogs','newPosts'));
    }

    public function post($id)
    {
        // get data
        $post = News::find($id);
        if($post){
            $postRelate = News::inRandomOrder()->limit(3)->get();

            return view('client.blogs.post',compact('post','postRelate'));
        }
        return route('404');
    }
}
