<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLoaiRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "loai" => "required|max:255",
        ];
    }
    public function messages(){
        return [
            'loai.required' => 'Tên loại bắt buộc phải nhập',
        ];
    }
}
