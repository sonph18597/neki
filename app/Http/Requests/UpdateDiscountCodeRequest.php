<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountCodeRequest extends FormRequest
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
            'discount_code'=>'required|max:255',
            'exclude_prod'=>'nullable',
            'include_prod'=>'nullable',
            'condition_type'=>'nullable',
            'type_discount'=>'nullable',
            'discount_number'=>'required|numeric',
            'limits'=>'required',
            'time_start'=>'required|date',
            'time_end'=>'required|date',
        ];
    }
}
