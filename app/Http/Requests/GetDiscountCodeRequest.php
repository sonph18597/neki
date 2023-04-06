<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetDiscountCodeRequest extends FormRequest
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
            'discount_code'=>'nullable',
            'exclude_prod'=>'nullable',
            'include_prod'=>'nullable',
            'condition_type'=>'nullable',
            'type_discount'=>'nullable',
            'discount_number'=>'nullable',
            'limits'=>'nullable',
            'time_start'=>'nullable',
            'time_end'=>'nullable',

        ];
    }
}
