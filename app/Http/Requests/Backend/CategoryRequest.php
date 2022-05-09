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
       return true;
    }

   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        // find category => ignore validate unique
        if($request->file('avatar')){
            $ruleAvatarEdit = "required|image|mimes:jpg,png,jpeg|max:2040";
        }else{
            $ruleAvatarEdit = 'nullable';
        }

        // check method
        switch($request->method()){
            case"PUT":
                $rules = [
                    "name" => ["required","max:30",Rule::unique('categories','name')->ignore(request()->id)],
                    "slug" => [Rule::unique('categories','slug')->ignore(request()->id)],
                    "avatar" => $ruleAvatarEdit,
                ];

                break;
                
                default:

                // xu li validate khi add danh muc con unique voi danh muc cap 0, con lai ignore
                $categoryUnique = Category::where('parent_id',0)->get()->toArray();
                $arrCategoryUniqueId = array();
                foreach($categoryUnique as $item){
                    array_push($arrCategoryUniqueId,$item['id']);
                }

                if($request->parent_id == 0){

                    $nameRules= ["required","max:30",'unique:categories'];
                }
                else{
                    $nameRules= ["required","max:30"];
                }
                
                $rules = [
                    "name" => $nameRules,
                    "avatar" => "required|image|mimes:jpg,png,jpeg|max:2040",
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
    //  protected function prepareForValidation()
    //  {
    //      $this->merge([
    //          'slug' => Str::slug($this->name),
    //      ]);
    //  }

    // sau khi validate 
    // public function withValidator($validator){
    //     if($validator->has($validator->errors())){

    //     }
    // }



}
