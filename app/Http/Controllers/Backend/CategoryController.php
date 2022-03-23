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
        $categories = Category::all();

        return view('admin.categories.list', compact('categories'));
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
        $categories = Category::all()->toArray();

        $listSelectSub = getChildCategories($categories);

        return view('admin.categories.add', compact('listAttr','categories','listSelectSub'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check neu select parent categories thi xac dinh muc con, nguoc lai la danh muc thong thuong.
        //validate
        $request->validate([
            "name" => "required|unique:categories|max:30",
            "slug" => "required|unique:sub_categories,sub_cate_slug|alpha_dash",
            "avatar" => "required|image| mimes:jpg,png,jpeg|max:2040",
            "attr_id"=>"required"

        ]);// create filename & uploads file & save
        $fileName = uniqid() . '-category' . time() . '.' . $request->avatar->extension();
        $request->file('avatar')->move(public_path('uploads'), $fileName);

        $category = new Category();
        $category->fill($request->all());
        $category->avatar = $fileName;
        $category->save();

        // add color vs size + other attr_id

        // ktra thuoc tinh co dc ng dung checked thi add them vo arrAttr de them 1 luot lun =))
        $arrAttrNew = [1, 2];
        if ($request->has('attr_id')) {
            $arrAttrId = $request->all()['attr_id'];

            foreach ($arrAttrId as $id) {
                array_push($arrAttrNew, (int)$id);
            }
        }

        // loop & create cate_attributes
        foreach ($arrAttrNew as $attrId) {

            $categoryAttribute = new CategoryAttribute();
            $categoryAttribute->attr_id = $attrId;
            $categoryAttribute->cate_id = $category->id;
            $categoryAttribute->save();
        }

        return redirect(route('categories.index'))->with('msg-suc', 'Them thanh cong danh muc moi');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get data

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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(Category::find($id)){
           Category::destroy($id);
           return redirect(route('categories.create'))->with('msg','Xoa thanh cong category');
       }
    }
}
