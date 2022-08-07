<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data
        $attributes = Attribute::all();
        $attributeValues = AttributeValue::select('attr_values.*','attributes.name as attr_name')
                                            ->join('attributes','attributes.id','attr_values.attr_id')
                                            ->orderBy('id','desc')
                                            ->paginate(10);
        //check attributes > 0 => btn add attrValue disable? 
        $btnStatus = '';
        if($attributes->count() == 0){
            $btnStatus = 'disabled';
        }
        return view('admin.attribute.list', compact('attributes','attributeValues','btnStatus'));
    }

    
    // save attribute
    public function store(Request $request){
        $request->validate(['name'=>'required','name'=>'min:3|max:50']);
        $attribute = new Attribute();

        $attribute->name = $request->name;

        try{
            $attribute->save();
            return redirect()->back()->with('msg-suc','Thêm thành công thuộc tính mới!');
        }catch(\Throwable $e){
            report($e);
            return false;
        }
    }

   
}
