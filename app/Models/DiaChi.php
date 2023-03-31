<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChi extends Model
{
    use HasFactory;
    protected $table = 'dia_chi';
    protected $fillable = ['id', 'tinh_thanh_pho', 'quan_huyen', 'phuong_xa', 'chi_tiet'];
}
