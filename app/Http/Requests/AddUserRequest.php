<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
                'password'=>'required|max:32',
                'id_dia_chi'=>'nullable',
                'role_id'=>'nullable',
                'gioi_tinh'=>'nullable',
                'anh'=>'nullable',
                'trang_thai'=>'nullable|numeric',
                'delete_at'=>'nullable'
        ];
    }
    public function messages(){
        return [
            'ten.required' => 'Tên là trường bắt buộc',
            'so_dien_thoai.required' => 'Số điện thoại là trường bắt buộc' ,
            'email.required' => 'Email là trường bắt buộc',
            'password' => 'Password là trường bắt buộc'
        ];
    }
}
