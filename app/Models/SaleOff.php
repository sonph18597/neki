<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SaleOff extends Model
{
    use HasFactory;
    protected $table = 'sale_off';
    protected $fillable= ['id','ten','mo_ta','phan_tram','time_start','time_end']; 


    ///
    // public function loadListWithPager($param=[])
    // {
    //     $query =DB::table($this->table)->select($this->fillable);
    //     $lists=$query->paginate(10);
    //     return $lists;
    // }
}
