<?php
use App\Models\Category;
use App\Models\SubCategories;

// func lay thuoc tinh san pham tu danh muc
if (!function_exists('getAttrByCate')) {
    function getAttrByCate($cateId){
        $result = SubCategories::select('attributes.name')
        ->join('cate_attributes','cate_attributes.cate_id','sub_categories.id')
        ->join('attributes','attributes.id','cate_attributes.attr_id')
        ->where('sub_categories.id',$cateId)->get();
        return $result;
    }
}