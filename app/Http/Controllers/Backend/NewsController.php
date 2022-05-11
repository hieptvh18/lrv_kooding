<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data
        $news = News::all();

        return view('admin.news.list',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>"required|min:6|max:225",
            'short_desc'=>"required|min:20|max:225",
            'content'=>"required|min:50",
            'image'=>"required|mimes:jpeg,png,jpg|max:2024",
        ],[
            'required'=>'Không được để trống!',
            "title.min"=>"Tiêu đề ít nhất 6 kí tự",
            "short_desc.min"=>"Mô tả ngắn ít nhất 20 kí tự",
            "content.min"=>"Nội dung ngắn ít nhất 50 kí tự",
        ]);

        $fileName = uniqid().'-post-avatar'.time().'.'.$request->file('image')->extension();
        $news = new News();
        $news->fill($request->all());
        $news->author_id = Auth::id();
        $news->image = $fileName;
        $save = $news->save();

        if($save){
            $request->file('image')->move(public_path('uploads'),$fileName);
            return redirect(route('news.index'))->with('msg-suc','Tạo thành công tin tức!');
        }
        return back()->with('msg-er','Lỗi trong quá trình thêm tin tức!');

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
        $post = News::find($id);

        if($post){
            return view('admin.news.edit',compact('post'));
        }
        return route('404');
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
        if($request->file('image')){
            $ruleImg = "required|mimes:jpeg,png,jpg|max:2024";
        }
        $ruleImg = "nullable";
        $request->validate([
            'title'=>"required|min:6|max:225",
            'short_desc'=>"required|min:20|max:225",
            'content'=>"required|min:50",
            'image'=>$ruleImg,
        ],[
            'required'=>'Không được để trống!',
            "title.min"=>"Tiêu đề ít nhất 6 kí tự",
            "short_desc.min"=>"Mô tả ngắn ít nhất 20 kí tự",
            "content.min"=>"Nội dung ngắn ít nhất 50 kí tự",
        ]);

        $news = News::find($id);
        $news->fill($request->all());
        if($request->file('image')){
            $fileName = uniqid().'-post-avatar'.time().'.'.$request->file('image')->extension();
            $news->image = $fileName;

            // unlink
            if(file_exists(public_path('uploads/'.$news->image))){
                unlink(public_path('uploads/'.$news->image));
            }
            $request->file('image')->move(public_path('uploads'),$fileName);
        }else{
            $fileName = $request->image;
        }
        $news->author_id = Auth::id();
        $news->image = $fileName;
        $save = $news->save();

        if($save){
            return redirect(route('news.index'))->with('msg-suc','Update thanh công tin tức!');
        }
        return back()->with('msg-er','Tạo thành công tin tức!');
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
        $post = News::find($id);

        if($post){
             // unlink
             if(file_exists(public_path('uploads/'.$post->image))){
                unlink(public_path('uploads/'.$post->image));
            }
            News::destroy($id);
            return back()->with('msg-suc','Xóa thành công!');
        }
        return back()->with('msg-er','Xóa thất bại');
    }
}
