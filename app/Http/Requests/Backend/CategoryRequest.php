<?php

namespace App\Http\Requests\Backend;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        // find category => ignore validate unique
        $category = Category::where('name',$request->input('name'))->first();

        if($request->file('avatar')){
            $ruleAvatarEdit = "required|image|mimes:jpg,png,jpeg|max:2040";
        }else{
            $ruleAvatarEdit = 'nullable';
        }

        // check method
        switch($request->method()){
            case"PUT":
                $rules = [
                    "name" => ["required","max:30",Rule::unique('categories')->ignore($category->id)],
                    "slug" => ["required",Rule::unique('categories')->ignore($category->id)],
                    "avatar" => $ruleAvatarEdit,
                    "attr_id"=>"required"
                ];

                break;
                
                default:
                $rules = [
                    "name" => ["required","unique:categories","max:30"],
                    "slug" => "required|unique:categories,slug|alpha_dash",
                    "avatar" => "required|image|mimes:jpg,png,jpeg|max:2040",
                    "attr_id"=>"required"
                ];
                break;
        }

        return $rules;
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

     // chuan bi truoc khi validate
     protected function prepareForValidation()
     {
         $this->merge([
             'slug' => Str::slug($this->slug),
         ]);
     }

    // sau khi validate 
    // public function withValidator($validator){
    //     if($validator->has($validator->errors())){

    //     }
    // }



}
