<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Loai extends Model
{
    use HasFactory;
    protected $table = 'loai';
    protected $fillable = ['id', 'loai','gioi_tinh'];
    public function loadListWithPager($param = []) {
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->where('delete_at', '!=', null);

        if(isset($param['loai']) ) {
            $query->where("loai" , "LIKE" , "%".$param['loai']."%" );
        }
        if(isset($param['gioi_tinh'])) {
            $query->where('gioi_tinh',"=", $param['gioi_tinh'] );
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
    //load ra chi tiết loai
    public function loadOne($id,$params = []) {
        $query = DB::table($this->table)
            ->where('id','=',$id)
            ->where('delete_at', '!=', null);
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
