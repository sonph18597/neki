<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetUserRequest extends FormRequest
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
            'ten' => 'nullable|string|max:255',
            'so_dien_thoai'=>'nullable',
            'email'=>'nullable|email',
            'password'=>'nullable|max:32',
            'id_dia_chi'=>'nullable',
            'role_id'=>'nullable',
            'gioi_tinh'=>'nullable',
            'anh'=>'nullable',
            'trang_thai'=>'nullable|numeric',
            'limit'=>'nullable'
        ];
    }
}
