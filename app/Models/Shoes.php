<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class Shoes extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = "shoes";
    protected $fillable = ['id', 'name', 'id_prod_sale','img', 'id_type', 'description', 'list_variant', 'price','sale_price', 'time_end_sale', 'time_start_sale'];
    public function loadListWithPager($param = []) {
        $query = DB::table($this->table)
        ->leftJoin('so_luong_gia', 'shoes.id', '=', 'so_luong_gia.id_giay')
        ->leftJoin('size', 'so_luong_gia.id_size', '=', 'size.id')
        ->leftJoin('mau', 'so_luong_gia.id_mau', '=', 'mau.id')
        ->select('shoes.name', 'shoes.price','shoes.img','shoes.id_type','shoes.description','shoes.id_prod_sale','shoes.sale_price','shoes.time_end_sale','shoes.time_start_sale', DB::raw('JSON_EXTRACT(list_variant, "$.size") as size'), DB::raw('JSON_EXTRACT(list_variant, "$.color") as color'), DB::raw('JSON_EXTRACT(list_variant, "$.so_luong") as so_luong'))
        ->where('delete_at', '=', null)
        ->get();
        if(isset($param['name']) ) {
            $query->where("name" , "LIKE" , "%".$param['name']."%" );
        }
        if(isset($param['description'])) {
            $query->where('description',"LIKE", "%".$param['description']."%" );
        }
        $lists = $query->paginate(10);
        return $lists;
    }
    //thêm mới
    public function saveNew($params){
        $data = $params['cols'];
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }
    //load ra chi tiết
    public function loadOne($id,$params = []) {
        $query = DB::table($this->table)->where('delete_at', '=', null)
            ->where('id','=',$id);
        $obj = $query->first();
        return $obj;
    }
    //sửa
    public function saveUpdate($params) {
        if (empty($params['cols']['id'])) {
            Session::push('errors','không xác định bản ghi cập nhập');
        }
        $dataUpdate = [];
        foreach ($params['cols'] as $colName =>$val) {
            if ($colName == 'id') continue;
            $dataUpdate[$colName] = (strlen($val) == 0) ? null:$val;
        }
        $res = DB::table($this->table)
            ->where('id',$params['cols']['id'])
            ->update($dataUpdate);
        return $res;
    }
}
