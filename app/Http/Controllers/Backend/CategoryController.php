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
    public function index(Request $request)
    {
      
        // search category
       
        // $categories = $categories->orderByDesc('categories.id')->paginate(5);

        // return view('admin.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //get data
        $categories = Category::select('*');
        $searchTitle = '';
        $type = 'asc';//type sort by category

        if($request->keyword){
            $searchTitle = $request->keyword;
            $categories = $categories->where('name','like','%'.$request->keyword.'%');
        }

        // sort
        if($request->_sort){
            if($request->type == 'asc'){
                $categories = $categories->orderBy($request->column,$request->type);
                $type = 'desc';
            }else{
                $categories = $categories->orderBy($request->column,$request->type);
                $type = 'asc';
            }
        }

        $categoryToArray = Category::all()->toArray();
        $categories = $categories->orderByDesc('categories.id')->paginate(3);

        $listSelectSub = getChildCategories($categoryToArray);

        return view('admin.categories.add', compact('categoryToArray','listSelectSub','categories','searchTitle','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $categoryRequest)
    {
        // validate = FormRequest

        // create filename & uploads file & save
        $fileName = uniqid() . '-category' . time() . '.' . $categoryRequest->avatar->extension();
        $categoryRequest->file('avatar')->move(public_path('uploads'), $fileName);

        $category = new Category();
        $category->fill($categoryRequest->all());
        $category->avatar = $fileName;
        $category->save();

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
        $listSelectSub = getChildCategories($categoryArray);

        // dd($attrOfCategories);
        return view('admin.categories.edit', compact('myCategory', 'listSelectSub'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $categoryRequest,Category $cate, $id)
    {
        $category = Category::find($id);
        // create filename & uploads file & save
        if ($categoryRequest->file('avatar')) {
            // unlink avatar old 
            if (file_exists(public_path('uploads/' . $category->avatar))) {
                unlink(public_path('uploads/' . $category->avatar));
            }
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
        if (file_exists(public_path('uploads/' . $category->avatar))) {
            unlink(public_path('uploads/' . $category->avatar));
        }
        Category::destroy($id);
        return redirect(route('categories.create'))->with('msg-suc', 'Remove category success!');
    }
}
