<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddShoesRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'id_prod_sale'=>'required|numeric',
            'img'=>'required',
            'description'=>'nullable|max:255',
            'id_type'=>'nullable|numeric',
            'list_variant'=>'nullable',
            'price'=>'required|numeric',
            'sale_price'=>'nullable|numeric',
            'time_end_sale'=>'nullable|date',
            'time_start_sale'=>'nullable|date',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Trường bắt buộc phải nhập',
            'id_prod_sale.required' => 'Trường bắt buộc phải nhập',
            'img.required' => 'Trường bắt buộc phải nhập',
            'price.required' => 'Trường bắt buộc phải nhập',
        ];
    }
}
