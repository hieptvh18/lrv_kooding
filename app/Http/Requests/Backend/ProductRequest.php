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
                    "name" => ["required","max:30",Rule::unique('products','name')->ignore(request()->id)],
                    "slug" => [Rule::unique('products','name')->ignore(request()->id)],
                    "avatar" => $ruleAvatarEdit,
                    "discount" => "nullable|integer|11",
                    "price" => "required|integer|between:10000,10000000",
                    // "quantity" => "required|integer",
                    "description" => "required|min:30|max:4000000",

                ];

                break;
                
                default:
                // rules create
                $rules = [
                    "name" => ["required","unique:products","max:300"],
                    "category_id" => "required",
                    "price" => "required|integer|between:10000,10000000",
                    "discount" => "nullable|regex:/^\d{1,11}$/",
                    "brand_id" => "required",
                    "description" => "required|min:30|max:4000000",
                    "avatar" => "required|image|mimes:jpg,png,jpeg|max:2040",
                    "quantity" => "required|integer",
                    "color_id"=>"required",
                    "size_id"=>"required",
                    "material_id"=>"required",
                    
                ];
                break;
        }

        return $rules;
    }

    // customer message
    public function messages()
    {
        return [
            "required"=>"Kh??ng ???????c ????? tr???ng!",
            "max"=>"????? d??i t???i ??a l?? :max k?? t??",
            "min"=>"????? d??i t???i thi???u l?? :min k?? t??",
            "unique"=>":attribute ???? t???n t???i trong d??? li???u",
            "avatar.image"=>"File t???i l??n ph???i l?? ???nh",
            "avatar.max"=>"???nh kh??ng ???????c qu?? 2mb!",
            "avatar.mimes"=>"Ch??? nh???n file ???nh d???ng jpg,png,jpeg",
            "integer" =>"Gi?? tr??? ph???i l?? s??? nguy??n",
            "between"=>"Gi?? tr??? ph???i n???m trong kho???ng 10000 - 10000000"

        ];
    }

    // custom :attribute
    public function attributes(){
        return [
            "name"=>"T??n danh m???c",
            "attr_id"=>"Thu???c t??nh"
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
