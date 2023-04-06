<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DonHang extends Model
{
    use HasFactory;
    protected $table = 'don_hang';
    protected $fillable = ['id', 'tong_so_luong', 'tong_tien', 'ho_ten', 'id_dia_chi', 'so_dien_thoai', 'user_id', 'xac_nhan', 'trang_thai','created_at'];
    public function loadListWithPager($param = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable,'san_pham_don_hang.id','san_pham_don_hang.so_luong','shoes.name')
            ->join('san_pham_don_hang', function ($join){
                $join->on('san_pham_don_hang.id_don_hang','=','don_hang.id')
                    ->where('san_pham_don_hang.delete_at','=','null');
            })  
            ->join('shoes', function ($join){
                $join->on('shoes.id','=','san_pham_don_hang.id_san_pham');
            })
            ->where('don_hang.delete_at', '=', null);

        if (isset($param['so_dien_thoai'])) {
            $query->where("don_hang.so_dien_thoai", "LIKE", "%" . $param['so_dien_thoai'] . "%");
        }
        if (isset($param['trang_thai'])) {
            $query->where('don_hang.trang_thai', "=", $param['trang_thai']);
        }
        if (isset($param['user_id'])) {
            $query->where('don_hang.user_id', "=", $param['user_id']);
        }
        if (isset($param['xac_nhan'])) {
            $query->where('don_hang.xac_nhan', "=", $param['xac_nhan']);
        }
        if(isset($param['limit'])){
            $query->limit($param['limit']);
        }
        $query->orderBy('don_hang.created_at');
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
            ->where('id', '=', $id)
            ->where('delete_at',"=",null);
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
    public function tongTienCacThangTruoc($thangDau,$thangCuoi)
    {
        $startDayOfMonth  = Carbon::create($thangDau)->startOfMonth()->format('Y-m-d'); 
        $endDayOfMonth = Carbon::create($thangCuoi)->endOfMonth($thangCuoi)->format('Y-m-d');
        
        $start_month = strtotime($thangDau);
        $end_month = strtotime($thangCuoi);
        // Lấy danh sách đơn hàng$startOfMonth->format('Y-m-d') trong khoảng thời gian từ tháng đầu đến tháng cuối
        $orders = DB::table($this->table)
                    ->select('tong_tien','created_at')
                    ->whereBetween('created_at', [ $startDayOfMonth,   $endDayOfMonth ])
                    ->where('delete_at','=',null)
                    ->orderBy('created_at', 'asc')
                    ->get()
                    ->toArray();
        // Tính tổng số tiền của mỗi tháng
        $total_by_month = array();
        foreach ($orders as $order) {
          $order_date = strtotime($order->created_at);
          $order_month = date('m-Y', $order_date);
          $order_total = $order->tong_tien;
        
          if (!isset($total_by_month[$order_month])) {
            $total_by_month[$order_month] = 0;
          }
          $total_by_month[$order_month] += $order_total;
        }
        
        // Hiển thị tổng số tiền của mỗi tháng
        $tongtien = [];
        foreach ($total_by_month as $month => $total) {
          $tongtien[$month] = $total;
        }
        return $tongtien;
    }
}
