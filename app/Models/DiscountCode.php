<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;
class DiscountCode extends Model
{
    use HasFactory;
    protected $table = "discount_code";
    protected $fillable = ['id', 'discount_code', 'exclude_prod','include_prod', 'condition_type', 'type_discount', 'discount_number', 'limits','time_start', 'time_end'];
    public function loadListWithPager($param = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable);
        $lists = $query->paginate(10);
        return $lists;
    }



    public function saveNew($param)
    {
        $data = array_merge($param['cols'], [
            'discount_code' => Hash::make($param['cols']['discount_code'])
        ]);
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }
    public function loadOne($id, $param = null)
    {
        $query = DB::table($this->table)->where('id', '=', $id);
        $obj = $query->first();
        return $obj;
    }
    public function saveUpdate($param)
    {
        if (empty($param['cols']['id'])) {
            Session::flash('error', 'Không xác định bản ghi cập nhật');
            return null;
        }
        $dataUpdate = [];
        foreach ($param['cols'] as $colName => $val) {
            if ($colName == 'id') continue;
            if (in_array($colName, $this->fillable)) {
                $dataUpdate[$colName] = (strlen($val) == 0) ? null : $val;
            }
        }
        $res = DB::table($this->table)
            ->where('id', $param['cols']['id'])
            ->update($dataUpdate);
        return $res;
    }
}
