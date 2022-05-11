<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    // find attr value
    public function findOne($id)

    {
        $attrValue  = AttributeValue::find($id);

        if(is_null($attrValue)){
            return response()->json([
                'success'=>false,
                'message'=>'Không tìm sản thuộc tính sản phẩm',
                'data'=>[]
            ],200);
        }
        
        return $attrValue;
    }
}
