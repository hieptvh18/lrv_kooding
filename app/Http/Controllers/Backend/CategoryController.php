<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CategoryRequest;
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
        $categories = Category::orderByDesc('categories.id')->paginate(3);

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
    public function update(CategoryRequest $request, $id)
    {
        if ($request->file('avatar')) {
            $ruleAvatarFiles = "image|mimes:jpg,png,jpeg|max:2040";
        } else {
            $ruleAvatarFiles = 'nullable';
        }

        $request->validate([
            "avatar" => $ruleAvatarFiles
        ]);

        $category = Category::find($id);

        // create filename & uploads file & save
        if ($request->file('avatar')) {
            // unlink avatar old 
            if (public_path('uploads/' . $category->avatar)) {
                unlink(public_path('uploads/' . $category->avatar));
            }
            // create fileNakme
            $fileName = uniqid() . '-category' . time() . '.' . $request->avatar->extension();
            $request->file('avatar')->move(public_path('uploads'), $fileName);
        } else {
            $fileName = $request->input('avatar');
        }

        $category->name = $request->input('name');
        $category->avatar = $fileName;
        // parent_id is field nullable
        if($request->parent_id != null){
            $category->parent_id = $request->parent_id;
        }
        $category->save();

        // add color vs size + other attr_id

        // remove value old => add new =))

        $attrOfCategories =  $attrOfCategories = Category::select('attributes.*')
        ->join('cate_attributes','cate_attributes.category_id','categories.id')
        ->join('attributes','attributes.id','cate_attributes.attr_id')
        ->where('categories.id',$id)
        ->get();

        foreach($attrOfCategories as $attr){

        }

        $arrAttrNew = [];
        if ($request->has('attr_id')) {
            $arrAttrId = $request->all()['attr_id'];

            foreach ($arrAttrId as $id) {
                array_push($arrAttrNew, (int)$id);
            }

            // lap va edit danh muc
            foreach ($arrAttrNew as $attrId) {

                $categoryAttribute = CategoryAttribute::where('attr_id', $attrId)
                    ->where('category_id', $id)->first();
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
