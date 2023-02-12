<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShoesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        //de lay phuong thuc hien tai

        switch ($this->method()):
            case 'POST':
                switch ($currentAction) {
                    case 'add':
                        $rules = [
                            "id_prod_sale" => "required|unique:shoes",
                            "name" => "required",
                            "list_img" => "required",
                            "id_type" => "required",
                            "description" => "required",
                            "list_variant" => "required",
                            "min_price" => "required",
                            "max_price" => "required",

                        ];
                    default:
                        break;
                }
                break;
            default:
                break;
        endswitch;
        return $rules;
    }
    public function messages()
    {
        return [
            'id_prod_sale.required' => 'Bắt buộc phải nhập thông tin',
            'id_prod_sale.unique' => 'id đã tồn tại',
            'name.required' => 'Bắt buộc phải nhập tên',
            'id_type.required' => 'Bắt buộc phải nhập loại',
            'description.required' => 'Bắt buộc phải nhập mô tả',
            'list_variant.required' => 'Bắt buộc phải nhập thông tin',
            'min_price.required' => 'Bắt buộc phải nhập giá nhỏ nhất',
            'max_price.required' => 'Bắt buộc phải nhập giá lớn nhất',

        ];
    }
}
