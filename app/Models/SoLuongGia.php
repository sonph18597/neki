<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
    public function loadListWithPager($param = []) {
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->where('delete_at', '=', null);
        if(isset($param['gia']) ) {
            $query->where("gia" , "LIKE" , "%".$param['gia']."%" );
        }
        if(isset($param['gia'])) {
            $query->where('gia',"=", $param['gia'] );
        }
        if(isset($param['id_mau'])) {
            $query->where('id_mau',"=",$param['id_mau'] );
        }
        if(isset($param['id_size'])) {
            $query->where('id_size',"=",$param['id_size'] );
        }
        $lists = $query->paginate(10);
        return $lists;
    }
    public function saveNew($params){
        $data = $params['cols'];
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }

    public function loadOne($id,$params = []) {
        $query = DB::table($this->table)
            ->where('id','=',$id)
            ->where('delete_at', '=', null);
        $obj = $query->first();
        return $obj;
    }


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
