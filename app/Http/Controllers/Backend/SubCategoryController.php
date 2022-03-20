<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategories;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Attribute;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //    validate
         $request->validate([
            "name" => "required|unique:sub_categories|max:30",
            "category_id" => "required",
            "sub_cate_slug" => "required|unique:sub_categories,sub_cate_slug|alpha_dash",
            "avatar" => "required|image| mimes:jpg,png,jpeg|max:2040",
            "attr_id"=>"required"
        ]);

        // create filename & uploads file & save
        $fileName = uniqid() . '-category' . time() . '.' . $request->avatar->extension();
        $request->file('avatar')->move(public_path('uploads'), $fileName);

        $category = new SubCategories();
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
        $myCategory = SubCategories::find($id);
        $listAttr = Attribute::all();

        return view('admin.categories.edit-subcategory', compact('myCategory', 'listAttr'));
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
        // dd($request->all());
        // validate
        if ($request->file('avatar')) {
            $ruleAvatarFiles = "image|mimes:jpg,png,jpeg|max:2040";
        } else {
            $ruleAvatarFiles = 'nullable';
        }

        $request->validate([
            "name" => "required|max:30",
            "avatar" => $ruleAvatarFiles
        ]);

        $category = SubCategories::find($id);

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
        $category->save();

        // add color vs size + other attr_id

        // ktra thuoc tinh co dc ng dung checked thi add them vo arrAttr de them 1 luot lun =))
        $arrAttrNew = [];
        if ($request->has('attr_id')) {
            $arrAttrId = $request->all()['attr_id'];

            foreach ($arrAttrId as $id) {
                array_push($arrAttrNew, (int)$id);
            }

            // lap va edit danh muc
            foreach ($arrAttrNew as $attrId) {

                $categoryAttribute = CategoryAttribute::where('attr_id', $attrId)
                    ->where('cate_id', $id)->first();
                $categoryAttribute->attr_id = $attrId;
                $categoryAttribute->cate_id = $category->id;
                $categoryAttribute->save();
            }
        } else {
            // ko check thif ktra va remove tru attr_id = 1 & 2 ra con lai eo co la xoa het

        }


        return redirect(route('categories.edit-subcategory', $id))->with('msg-suc', 'Update success!');
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

         $category = SubCategories::find($id);
         if(!$category){
             return redirect(route('categories.index'))->with('msg','Xoa that bai');
         }
         if (public_path('uploads/' . $category->avatar)) {
             unlink(public_path('uploads/' . $category->avatar));
         }
         SubCategories::destroy($id);
         return redirect(route('categories.index'))->with('msg-suc', 'Remvoe category success!');
    }
}
