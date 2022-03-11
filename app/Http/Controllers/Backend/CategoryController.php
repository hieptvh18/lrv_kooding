<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\CategoryAttribute;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('admin.categories.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get data
        $listAttr = Attribute::all();

        return view('admin.categories.add',['listAttr'=>$listAttr]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all()['name']);
        if(Attribute::count() == 0){
            // dua ra error bat tao them attribute truoc
            return back()->with('msg-er','Can tao moi it nhat mot thuoc tinh san pham');
        }
        //
        $request->validate([
            "name"=>"required|unique:categories|max:30",
            "avatar" =>"required|image"
        ]);
        $fileName = uniqid() . '-subject' . time() . '.' . $request->avatar->extension();
        $request->file('avatar')->move(public_path('uploads'), $fileName);

        $category = new Category();
        $category->name = $request->all()['name'];
        $category->avatar = $fileName;
        $category->save();

        // add color vs size + other attr_id

        // ktra thuoc tinh co dc ng dung checked thi add them vo arrAttr de them 1 luot lun =))
        $arrAttr = [1,2];
        foreach($arrAttr as $item){

        }

        // CategoryAttribute::create([
        //     'cate_id'=>$category->id,
        //     'attr_id'=>$request->all()['attr_id']
        // ]);

        return redirect(route('categories.index'))->with('msg','Them thanh cong danh muc moi');

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
