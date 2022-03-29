<?php

namespace App\Http\Requests\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $product = Product::where('name',$request->input('name'))->first();

        if($request->file('avatar')){
            $ruleAvatarEdit = "required|image|mimes:jpg,png,jpeg|max:2040";
        }else{
            $ruleAvatarEdit = 'nullable';
        }
        //['name','slug','category_id','price','discount','brand_id','avatar','description',','status'];
        // check method
        switch($request->method()){
            case"PUT":
                $rules = [
                    "name" => ["required","max:30",Rule::unique('products')->ignore(request()->id)],
                    "slug" => [Rule::unique('products')->ignore(request(    )->id)],
                    "avatar" => $ruleAvatarEdit,
                    "discount" => "nullable|integer|11",
                    "price" => "required|integer|max:11",
                    // "quantity" => "required|integer",
                    "description" => "required|min:30|max:4000000",

                ];

                break;
                
                default:
                // rules create
                $rules = [
                    "name" => ["required","unique:products","max:300"],
                    "category_id" => "required",
                    "price" => "required|regex:/^\d{1,11}$/",
                    "discount" => "nullable|regex:/^\d{1,11}$/",
                    "brand_id" => "required",
                    // "quantity" => "required|regex:/^\d{1,11}$/",
                    "description" => "required|min:30|max:4000000",
                    "avatar" => "required|image|mimes:jpg,png,jpeg|max:2040",
                    // "avatars" => "nullable|image|mimes:jpg,png,jpeg|max:2040",
                    // "color_id"=>"required",
                    // "size_id"=>"required",
                    // "material_id"=>"required",
                    
                ];
                break;
        }

        return $rules;
    }

    // customer message
    public function messages()
    {
        return [
            "required"=>"Không được để trống!",
            "max"=>"Độ dài tối đa là :max kí tư",
            "min"=>"Độ dài tối thiểu là :min kí tư",
            "unique"=>":attribute đã tồn tại trong dữ liệu",
            "avatar.image"=>"File tải lên phải là ảnh",
            "avatar.mimes"=>"Chỉ nhận file ảnh dạng jpg,png,jpeg",
            "integer" =>"Giá trị phải là số nguyên",

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
             'slug' => Str::slug($this->name),
         ]);
     }

    // sau khi validate 
    // public function withValidator($validator){
    //     if($validator->has($validator->errors())){

    //     }
    // }



}
