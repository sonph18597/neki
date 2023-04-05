<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Anh extends Model
{
    use HasFactory;
    protected $table = 'anh';
    protected $fillable = ['id', 'product_id', 'url'];

    public function loadListWithPager($param = []) {
        $query = DB::table($this->table)
            ->select($this->fillable)
          ;
        if(isset($param['product_id']) ) {
            $query->where("product_id" , "LIKE" , "%".$param['product_id']."%" );
        }
        if(isset($param['url'])) {
            $query->where('url',"=", $param['url'] );
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
            ->where('id','=',$id);
          
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
