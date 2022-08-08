<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{

    private $arrayBadWord = [
        'shit','me'
    ];
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // check tu bad word with regex -> convert to ***
        return [
            'content'=>"required|min:6|max:500",
            'image'=>'nullable|mimes:jpg,png,jpeg|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'content.required'=>'Nội dung không được để trống!',
            'content.min'=>"Nội dung quá ngắn",
            'content.max'=>"Nội dung quá dài",
            'image.max'=>"File ảnh quá lớn",
            'image.mimes'=>"File ảnh chỉ chấp nhận: jpg jpeg png",
        ];
    }
}
