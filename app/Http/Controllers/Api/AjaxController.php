<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AttributeValue;
use App\Models\Attribute;

class AjaxController extends Controller
{
    // check attribute value exist
    public function attrValueExist(Request $rq){
        if($rq->ajax()){
            
            // trong 1 attribtue chỉ có 1 thuộc tính duy nhất(méo cho trùng tên thuộc tính)
            $qr = AttributeValue::where('attr_values.value',$rq->value)
                ->join('attributes','attributes.id','attr_values.attr_id')
                ->where('attributes.id',$rq->attr_id)
                ->count();  
            if($qr > 0 ){
                return 1;
            }
            return 0;
        }
    }

  
}
