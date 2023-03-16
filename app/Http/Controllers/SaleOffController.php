<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleOff;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SaleOffController extends Controller
{
    public function index()
    {
        $sale_off = SaleOff::all();
        $sale_off = SaleOff::paginate(8); // phân trang
        return response()->json([
            "success" => true,
            "status_code" => 200,
            "title" => "Danh Sách Mã Giảm Giá (Sale Off)",
            "data" => $sale_off
        ]);
    }

    public function addSaleOff(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'ten' => 'required|max:255',
            'mo_ta' => 'required',
            'phan_tram' => 'integer|required|between:1,100',
            'time_start' => 'required',
            // định dạng |date_format:Y-m-d|after_or_equal:now
            'time_end' => 'required' // |date_format:Y-m-d|after_or_equal:from
        ]);
        if ($validator->fails()) {
            // return $this->sendError('Validation Error.', $validator->errors());
            return response()->json(["error" => 'Lỗi khi thêm, hãy thao tác lại'], 400);
        }
        $sale_off = SaleOff::create($input);
        return response()->json([
            "success" => true,
            "status_code" => 200,
            "title" => "Thêm Mã Giảm Giá Thành Công!",
            "data" => $sale_off
        ]);
    }


    // lấy ra danh sách , từng mã theo ID
    public function listSaleOff($id)
    {
        $sale_off = SaleOff::find($id);

        if (!$sale_off) {
            return response()->json(['error' => 'Không tìm thấy Mã Giảm Giá có ID ' . $id . ''], 404);
        }

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Đã tìm thành công Mã Giảm Giá có ID $id !",
            "data" => $sale_off
        ]);
    }


    // cập nhật mã giảm giá
    public function updateSaleOff(Request $request, $id)
    {
        $sale_off = SaleOff::find($id);

        if (!$sale_off) {
            return response()->json(['error' => 'Không tìm thấy Mã Giảm Giá có ID ' . $id . ''], 404);
        }

        $validatedData = $request->validate([
            'ten' => 'required',
            'mo_ta' => 'required',
            'phan_tram' => 'min:1,max:100',
            'time_start' => 'nullable|date',
            'time_end' => 'nullable|date'
        ]);

        $sale_off->update($validatedData);
        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Cập nhật thành công Mã Giảm Giá có ID $id !",
            "data" => $sale_off
        ]);
    }


    // xóa sale_off - mã giảm giá
    public function deleteSaleOff($id)
    {
        $sale_off = SaleOff::find($id);

        if (!$sale_off) {
            return response()->json(['error' => 'Không tìm thấy Mã Giảm Giá có ID ' . $id . ''], 404);
        }
        $sale_off->delete();
        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Xóa Thành công Mã giảm giá!",
            "data" => $sale_off
        ]);
    }


    //tìm kiếm, lọc
    public function search(Request $request)
    {
        $query = SaleOff::query();
        if ($search = $request->input('search')) {
            $query->whereRaw("ten LIKE '%" . $search . "%'")
                ->orWhereRaw("mo_ta LIKE '%" . $search . "%'")
                ->orWhereRaw("phan_tram LIKE '%" . $search . "%'");
        }
        if ($sort = $request->input('sort')) {
            $query->orderBy('ten', $sort);
        }

        $perPage = 8;
        $page = $request->input('page', 1);
        $total = $query->count();
        $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();
        return [
            'data' => $result,
            // trả về kết quá
            'total' => $total,
            // tổng số kết quả
            'page' => $page,
            // số trang
            'last_page' => ceil($total / $perPage) // trang cuối
        ];
        // return $query->get();
    }
}