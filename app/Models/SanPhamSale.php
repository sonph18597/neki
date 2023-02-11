<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPhamSale extends Model
{
    use HasFactory;
    protected $table = 'san_pham_sale';
    protected $fillable = ['id', 'id_sale_off','id_san_pham','gia_sale','so_luong'];
}
