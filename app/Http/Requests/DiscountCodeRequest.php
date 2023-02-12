<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountCodeRequest extends FormRequest
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
                            "discount_code" => "required|unique:discount_code",
                            "exclude_prod" => "required",
                            "include_prod" => "required",
                            "condition_type" => "required",
                            "type_discount" => "required",
                            "discount_number" => "required",
                            "limits" => "required",
                            "time_start" => "required",
                            "time_end" => "required",

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
            'discount_code.required' => 'Bắt buộc phải nhập thông tin',
            'discount_code.unique' => 'code đã tồn tại',
            'exclude_prod.required' => 'Bắt buộc phải nhập thông tin',
            'include_prod.required' => 'Bắt buộc phải nhập thông tin',
            'condition_type.required' => 'Bắt buộc phải nhập thông tin',
            'type_discount.required' => 'Bắt buộc phải nhập thông tin',
            'discount_number.required' => 'Bắt buộc phải nhập thông tin',
            'limits.required' => 'Bắt buộc phải nhập thông tin',
            'time_start.required' => 'Bắt buộc phải nhập thông tin',
            'time_end.required' => 'Bắt buộc phải nhập thông tin',

        ];
    }

}
