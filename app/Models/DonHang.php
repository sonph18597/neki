<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DonHang extends Model
{
    use HasFactory;
    protected $table = 'don_hang';
    protected $fillable = ['id','tong_so_luong','tong_tien','ho_ten','id_dia_chi','so_dien_thoai','user_id','xac_nhan','trang_thai'];
    public function loadListWithPager($param = []) {
        $query = DB::table($this->table) 
            ->select($this->fillable);
            
        if(isset($param['so_dien_thoai']) ) {
            $query->where("so_dien_thoai" , "LIKE" , "%".$param['so_dien_thoai']."%" );
        }
        if(isset($param['trang_thai'])) {
            $query->where('trang_thai',"=", $param['trang_thai'] );
        }
        if(isset($param['user_id'])) {
            $query->where('user_id',"=",$param['user_id'] );
        }
        if(isset($param['xac_nhan'])){
            $query->where('xac_nhan',"=",$param['xac_nhan'] );
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
    //load ra chi tiết người dùng
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
