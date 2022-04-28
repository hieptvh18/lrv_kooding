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
                                            ->paginate(10);
        //check attributes > 0 => btn add attrValue disable? 
        $btnStatus = '';
        if($attributes->count() == 0){
            $btnStatus = 'disabled';
        }
        return view('admin.attribute.list', compact('attributes','attributeValues','btnStatus'));
    }

   
}
