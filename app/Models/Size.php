<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class Size extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = "size";
    protected $fillable = ['id', 'size'];
    public function loadListWithPager($param = []) {
        $query = DB::table($this->table)
            ->select($this->fillable)->where('delete_at', '=', null);

        if(isset($param['size']) ) {
            $query->where("size" , "LIKE" , "%".$param['size']."%" );
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
            ->where('id','=',$id)
            ->where('delete_at', '=', null);
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
