<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryAttribute;

class CategoryAttrbuteController extends Controller
{
    //remove

    public function destroy($attr_id, $cate_id){

        //  use delete
        CategoryAttribute::where('attr_id',$attr_id)->where('cate_id',$cate_id)->delete();
        return redirect(route('categories.edit',$cate_id))->with('msg','Remove category attribute success!');
    }

    // add
    public function store(Request $rq ,$cate_id){
        dd($rq->all());
        
    }
}
