<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table = 'don_hang';
    protected $fillable = ['id','tong_so_luong','tong_tien','ho_ten','id_dia_chi','so_dien_thoai','user_id','xac_nhan'];
}
