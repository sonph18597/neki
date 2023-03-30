<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'ten' => 'required|string|max:255',
            'so_dien_thoai'=>'required',
            'email'=>'required|email',
            'password'=>'nullable|max:32',
            'id_dia_chi'=>'nullable',
            'role_id'=>'nullable',
            'gioi_tinh'=>'nullable',
            'anh'=>'nullable',
            'ngay_sinh'=>'nullable|date',
            'trang_thai'=>'nullable|numeric'
        ];
    }
}
