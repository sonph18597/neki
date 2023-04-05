<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAnhRequest extends FormRequest
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
            "url" => "required|max:255",
        ];
    }
    public function messages(){
        return [
            'product_id.required' => 'Mã sản phẩm bắt buộc phải nhập',
            'url.required' => 'URL bắt buộc phải nhập',
        ];
    }
}
