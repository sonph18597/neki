<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSoLuongGiaRequest extends FormRequest
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
            'id_mau' => 'nullable|numeric',
            'id_size'=>'nullable|numeric',
            'so_luong'=>'required|numeric',
            'gia'=>'required|numeric',
            'anh'=>'nullable'
        ];
    }
}
