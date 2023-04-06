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
class DiscountCode extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = "discount_code";
    protected $fillable = ['id', 'discount_code', 'exclude_prod','include_prod', 'condition_type', 'type_discount', 'discount_number', 'limits','time_start', 'time_end'];
    public function loadListWithPager($param = []) {
        $query = DB::table($this->table)
            ->select($this->fillable)->where('delete_at', '=', null);

        if(isset($param['discount_code']) ) {
            $query->where("discount_code" , "LIKE" , "%".$param['discount_code']."%" );
        }
        if(isset($param['discount_number'])) {
            $query->where('discount_number',"LIKE", "%".$param['discount_number']."%" );
        }
        if(isset($param['limits'])) {
            $query->where('limits',"LIKE", "%".$param['limits']."%" );
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
            ->where('id','=',$id)->where('delete_at', '=', null);
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
