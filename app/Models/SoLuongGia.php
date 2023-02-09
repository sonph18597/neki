<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoLuongGia extends Model
{
    use HasFactory;
    protected $table ="so_luong_gia";
    protected $fillable =[
        'id_mau',
        'id_size',
        'so_luong',
        'gia',
        'anh',
    ];
}
