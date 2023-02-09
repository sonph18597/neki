<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPhamDonHang extends Model
{
    use HasFactory;
    protected $table = 'san_pham_don_hang';
    protected $fillable = ['id', 'id_don_hang', 'id_san_pham', 'so_luong'];
}
