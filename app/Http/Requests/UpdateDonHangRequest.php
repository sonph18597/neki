<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDonHangRequest extends FormRequest
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
            //
            "trang_thai" => "nullable|numeric",
            "so_dien_thoai" => "nullable",
            "xac_nhan" => "numeric|nullable",
            "tong_so_luong" => "nullable",
            "tong_tien" => "nullable",
            "ho_ten" => "nullable",
            "id_dia_chi"=> "nullable",
            "delete_at" => "nullable"
        ];
    }
}
