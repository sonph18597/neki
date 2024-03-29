<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SanPhamDonHang extends Model
{
    use HasFactory;
    protected $table = 'san_pham_don_hang';
    protected $fillable = ['id', 'id_don_hang', 'id_san_pham', 'so_luong'];
    public function loadListWithPager($param = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable);
        if (isset($param['id_don_hang'])) {
            $query->where('id_don_hang', '=', $param['id_don_hang']);
        }
        if (isset($param['id_san_pham'])) {
            $query->where('id_san_pham', '=', $param['id_san_pham']);
        }
        if (isset($param['so_luong'])) {
            $query->where('so_luong', '=', $param['so_luong']);
        }
        $lists = $query->paginate(10);
        return $lists;
    }
    //thêm mới
    public function saveNew($params)
    {
        $data = $params['cols'];
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }
    //load ra chi tiết người dùng
    public function loadOne($id, $params = [])
    {
        $query = DB::table($this->table)
            ->where('id', '=', $id);
        $obj = $query->first();
        return $obj;
    }
    //sửa
    public function saveUpdate($params)
    {
        if (empty($params['cols']['id'])) {
            Session::push('errors', 'không xác định bản ghi cập nhập');
        }
        $dataUpdate = [];
        foreach ($params['cols'] as $colName => $val) {
            if ($colName == 'id') continue;
            $dataUpdate[$colName] = (strlen($val) == 0) ? null : $val;
        }
        $res = DB::table($this->table)
            ->where('id', $params['cols']['id'])
            ->update($dataUpdate);
        return $res;
    }
}
