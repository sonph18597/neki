<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetShoesRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'id_prod_sale'=>'nullable',
            'img'=>'nullable',
            'description'=>'nullable|max:255',
            'id_type'=>'nullable',
            'list_variant'=>'nullable',
            'price'=>'nullable',
            'sale_price'=>'nullable',
            'time_end_sale'=>'nullable|date',
            'time_start_sale'=>'nullable|date',
        ];
    }
}
