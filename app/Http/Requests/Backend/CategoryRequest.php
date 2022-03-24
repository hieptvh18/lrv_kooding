<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//cho phep ng dung thuc hien rq hay k
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        // define rules
        return [
            "name" => "required|unique:categories|max:30",
            "slug" => "required|unique:categories,slug|alpha_dash",
            "avatar" => "required|image| mimes:jpg,png,jpeg|max:2040",
            "attr_id"=>"required"
        ];
    }

    // customer message
    public function messages()
    {
        return [
            "required"=>"Bắt buộc nhập :attribute!",
            "name.max"=>"Độ dài tối đa là 30 kí tư",
            "unique"=>":attribute đã tồn tại trong dữ liệu",
            "slug.alpha_dash"=>"Slug chỉ nhận kí tự đặc biệt gồm _-",
            "avatar.image"=>"File tải lên phải là ảnh",
            "avatar.mimes"=>"Chỉ nhận file ảnh dạng jpg,png,jpeg",
        ];
    }

    // custom :attribute
    public function attributes(){
        return [
            "name"=>"Tên danh mục",
            "attr_id"=>"Thuộc tính"
        ];
    }

    // sau khi validate 
    // public function withValidator($validator){
    //     if($validator->has($validator->errors())){

    //     }
    // }

    // trước khi validate
    protected function prepareForValidation(){
        // do    something
    }

}
