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
    protected $fillable = ['id', 'name', 'id_prod_sale','img', 'id_type','bien_the', 'description', 'list_variant', 'price','sale_price', 'time_end_sale', 'time_start_sale'];
    public function loadListWithPager($param = []) {
        $query = DB::table($this->table)
        ->join('size', 'so_luong_gia.id_size', '=', 'size.id')
        ->join('mau', 'so_luong_gia.id_mau', '=', 'mau.id')
        ->join('so_luong_gia', 'shoes.id', '=', 'so_luong_gia.id_giay')
            ->select($this->fillable,'mau.mau as color', 'size.size as sizes', 'so_luong_gia.gia as prices')->get();

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
        $query = DB::table($this->table)
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
