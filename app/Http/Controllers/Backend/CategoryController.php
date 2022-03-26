<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\CateAttribute;
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
        $categories = Category::orderByDesc('categories.id')->paginate(5);

        return view('admin.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(\App\Models\Category::find(6)->attributes);
        //get data
        $listAttr = Attribute::all();
        $categories = Category::all()->toArray();
        $listCate = Category::orderByDesc('categories.id')->paginate(3);

        $listSelectSub = getChildCategories($categories);

        return view('admin.categories.add', compact('listAttr','categories','listSelectSub','listCate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $categoryRequest)
    {
        // dd($categoryRequest->all());
        // validate = FormRequest

        // create filename & uploads file & save
        $fileName = uniqid() . '-category' . time() . '.' . $categoryRequest->avatar->extension();
        $categoryRequest->file('avatar')->move(public_path('uploads'), $fileName);

        $category = new Category();
        $category->fill($categoryRequest->all());
        $category->avatar = $fileName;
        $category->save();
        $lastCateId = $category->id;

        // add color vs size + other attr_id
        // ktra thuoc tinh co dc ng dung checked thi add them vo arrAttr de them 1 luot lun =))

        // loop & create cate_attributes
        foreach ($categoryRequest->attr_id as $attrId) {
            $categoryAttribute = new CategoryAttribute();
            $categoryAttribute->attr_id = $attrId;
            $categoryAttribute->category_id = $lastCateId;
            $categoryAttribute->save();
        }

        return redirect(route('categories.create'))->with('msg-suc', 'Them thanh cong danh muc moi');
       
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
        $myCategory = Category::find($id);
        $categoryArray = Category::all()->toArray();
        $listAttr = Attribute::all();
        $listSelectSub = getChildCategories($categoryArray);
        // get attribute of cate
        $attrOfCategories = Category::select('attributes.*')
                                ->join('cate_attributes','cate_attributes.category_id','categories.id')
                                ->join('attributes','attributes.id','cate_attributes.attr_id')
                                ->where('categories.id',$id)
                                ->get();

        // dd($attrOfCategories);
        return view('admin.categories.edit', compact('myCategory', 'listAttr','attrOfCategories','listSelectSub'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $categoryRequest, $id)
    {
        $category = Category::find($id);
        // create filename & uploads file & save
        if ($categoryRequest->file('avatar')) {
            // unlink avatar old 
            // if (public_path('uploads/' . $category->avatar)) {
            //     unlink(public_path('uploads/' . $category->avatar));
            // }
            // create fileNakme
            $fileName = uniqid() . '-category' . time() . '.' . $categoryRequest->avatar->extension();
            $categoryRequest->file('avatar')->move(public_path('uploads'), $fileName);
        } else {
            $fileName = $categoryRequest->input('avatar');
        }

        $category->name = $categoryRequest->input('name');
        $category->avatar = $fileName;
        // parent_id is field nullable
        if($categoryRequest->parent_id != null){
            $category->parent_id = $categoryRequest->parent_id;
        }
        $category->slug = $categoryRequest->input('slug');
        $category->save();

        // add color vs size + other attr_id

        // remove value old => add new =))
        $attrOfCategories = CateAttribute::select('cate_attributes.*')
        ->where('category_id',$id)->delete();

        // lap va add 
        if ($categoryRequest->has('attr_id')) {
            foreach ($categoryRequest->attr_id as $attrId) {
                $categoryAttribute = new CategoryAttribute();
                $categoryAttribute->attr_id = $attrId;
                $categoryAttribute->category_id = $category->id;
                $categoryAttribute->save();
            }
        } 


        return redirect(route('categories.edit', $id))->with('msg-suc', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category){
            return redirect(route('categories.create'))->with('msg-er','Xoa that bai');
        }
        if (public_path('uploads/' . $category->avatar)) {
            unlink(public_path('uploads/' . $category->avatar));
        }
        Category::destroy($id);
        return redirect(route('categories.create'))->with('msg-suc', 'Remove category success!');
    }
}
