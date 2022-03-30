<?php
use App\Models\Category;
use App\Models\AttributeValue;

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


// get child cate
if(!function_exists('getChildCategories')){
    function getChildCategories(&$listData,$parentId=null,$level=0){
        // default truyen $parentId = null vi no la cap 0;
        // note $parentID = sub_categories_id
        $arr = array();
        foreach($listData as $key=>$val){

            // logic: find all parent -> find child of child ==> continue
            // level se la so cap bac de co the dung str_repeat lap
            $val['level'] = $level;
            if($val['parent_id'] == $parentId){
                $arr[] = $val;
            
                // callback
                $menuChild = getChildCategories($listData,$val['id'],$level+1);
                $arr = array_merge($arr,$menuChild);
            }
        }
        return $arr;
    }
}

// show menu select muntiple category admin

if(!function_exists('showSelectCategories')){
    function showSelectCategories($list, $num){
        $num++;
        foreach(array_unique($list,SORT_REGULAR) as $item){
            echo "<option value=".$item['id'].">".str_repeat("---",$num-1).$item['name']."</option>";
            // var_dump($item);
            if(!empty($item['child'])){
                showSelectCategories($item['child'],$num);
            }
        }
    }
}

// get info attr_value
if(!function_exists('getAttributeValue')){
    function getAttributeValue($id){
        $result = AttributeValue::where('id',$id)->first();

        return $result;
    }
}

