<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\CateAttribute;

class AjaxController extends Controller
{
    // check attribute value exist[form add attribute]
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

        // filter attribute of category[form add product]
    public function getAttrOfCategory(Request $rq){

        // if($rq->ajax()){
        //     $categoryAttribute = CateAttribute::select('attributes.*')
        //                                         ->join('attributes','attributes.id','cate_attributes.attr_id')
        //                                         ->where('cate_attributes.category_id',$rq->category_id)->get();

        //     // get value of atributes
        //     $result = '';
        //     foreach($categoryAttribute as $cate){
        //         $result += `
        //             <label for="" class="">Thuộc tính</label>
        //             <select id="" name="brand_id" class="form-control">
        //                 <option selected disabled value="">---chon thuong hieu---</option>
        //                 @foreach ($listBrand as $val)
        //                     <option value="{{ $val->id }}"
        //                         {{ old('brand_id') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
        //                 @endforeach
        //             </select>
        //             @error('brand_id')
        //                 <small class="text-danger">{{ $message }}</small>
        //             @enderror
        //         `;
        //     }

        //     return $result;

        // }
    }

  
}
