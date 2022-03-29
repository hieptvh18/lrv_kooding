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
        $listAttr = Attribute::all();
        $list_attr_value = AttributeValue::select('attr_values.*','attributes.name as attr_name')
                                            ->join('attributes','attributes.id','attr_values.attr_id')
                                            ->get();
        //check attributes > 0 => btn add attrValue disable? 
        $btnStatus = '';
        if($listAttr->count() == 0){
            $btnStatus = 'disabled';
        }
        return view('admin.attribute.list', compact('listAttr','list_attr_value','btnStatus'));
    }

   
}
