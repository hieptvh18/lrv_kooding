<?php
use App\Models\Category;

// func lay thuoc tinh san pham tu danh muc
if (!function_exists('getAttrByCate')) {
    function getAttrByCate($cateId){
        $result = Category::select('attributes.name')
        ->join('cate_attributes','cate_attributes.cate_id','categories.id')
        ->join('attributes','attributes.id','cate_attributes.attr_id')
        ->where('categories.id',$cateId)->get();
        return $result;
    }
}