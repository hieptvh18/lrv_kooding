<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
    public function rules()
    {
        return [
            "name"=>"required|max:255|min:6",
            "email"=>"required|unique:users|email",
            "password"=>"required|min:6|max:30|regex:/\w/",
            "phone"=>"required|unique:users|regex:/^(0+)\d{9,10}$/",
            "gender"=>"required",
            "role_id"=>"required",
        ];
    }

   // customer message
   public function messages()
   {
       return [
           "required"=>"Không được để trống!",
           "max"=>"Độ dài tối đa là :max kí tư",
           "min"=>"Độ dài tối thiểu là :min kí tư",
           "unique"=>":attribute đã tồn tại trong dữ liệu",
          "password.regex"=>":attribute chỉ được bao gồm chữ, số và dấu gạch dưới",
          "phone.regex"=>":attribute không hợp lệ"

       ];
   }

   // custom :attribute
   public function attributes(){
       return [
           "name"=>"Họ tên",
           "gender"=>"Giới tính",
           "phone"=>"Số điện thoại",
           "password"=>"Mật khẩu",
           "role_id"=>"Vai trò",
       ];
   }
}
