<?php

namespace App\Http\Controllers;

use App\Models\SanPhamSale;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SanPhamSaleController extends Controller
{
    //show
    public function index() // List SẢN PHẦM SALE   
    {
        $san_pham_sale = SanPhamSale::all();
        $san_pham_sale = SanPhamSale::paginate(8); // phân trang
        return response()->json([
            "success" => true,
            "status_code" => 200,
            "title" => "Danh sách Sản Phẩm Giảm Giá",
            "data" => $san_pham_sale
        ]);
    }


    //thêm sp sale
    public function addSanPhamSale(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id_sale_off' => 'required|unique:san_pham_sale',
            // trường ko được tồn tại trong DB
            'id_san_pham' => 'required',
            'gia_sale' => 'required|regex:/^\d*(\.\d{3})?$/',
            // làm tròn sau dấu . có 3 chữ số,
            'so_luong' => 'required|regex:/^\d*(\.\d{3})?$/',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Lỗi xác thực, hãy thử lại!',
                'errors' => $validator->errors(),
            ], 422);
            // return $this->sendError('Validation Error.', $validator->errors());
            // return response()->json(["error" => 'Lỗi khi thêm, hãy thao tác lại'], 400);
        }
        $san_pham_sale = SanPhamSale::create($input);
        return response()->json([
            "success" => true,
            "status_code" => 200,
            "title" => "Thêm Sản Phẩm Giảm Giá Thành Công!",
            "data" => $san_pham_sale
        ]);
    }

    // lấy ra danh sách , từng mã theo ID
    public function listSanPhamSale($id)
    {
        $san_pham_sale = SanPhamSale::find($id);

        if (!$san_pham_sale) {
            return response()->json(['error' => 'Không tìm thấy Sản Phẩm Giảm Giá có ID ' . $id . ''], 404);
        }
        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Đã tìm thành Sản Phẩm Giảm Giá có ID $id !",
            "data" => $san_pham_sale
        ]);
    }


    // cập nhật mã giảm giá
    public function updateSanPhamSale(Request $request, $id)
    {
        $san_pham_sale = SanPhamSale::find($id);
        $input = $request->all();
        if (!$san_pham_sale) {
            return response()->json(['error' => 'Không tìm thấy Sản Phẩm Giảm Giá có ID ' . $id . ''], 404);
        }
        $validator = Validator::make($input, [
            'id_sale_off' => 'required',
            'id_san_pham' => 'required',
            'gia_sale' => 'required|regex:/^\d*(\.\d{3})?$/',
            // làm tròn sau dấu . có 3 chữ số, vd: 300.000
            'so_luong' => 'required|regex:/^\d*(\.\d{3})?$/',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Lỗi xác thực, hãy thử lại!',
                'errors' => $validator->errors(),
            ], 422);
            // return $this->sendError('Validation Error.', $validator->errors());
            // return response()->json(["error" => 'Lỗi khi thêm, hãy thao tác lại'], 400);
        } 
            $san_pham_sale->update($input);
            return response()->json([
                "success" => true,
                "status_code" => 200,
                "message" => "Cập nhật thành công Sản Phẩm Giảm Giá có ID $id !",
                "data" => $san_pham_sale
            ]);
        
    }

    // delete san_pham_sale
    public function deleteSanPhamSale($id)
    {
        $san_pham_sale = SanPhamSale::find($id);
        if (!$san_pham_sale) {
            return response()->json(['error' => 'Không tìm thấy Sản phẩm Giảm Giá có ID ' . $id . ''], 404);
        }
        $san_pham_sale->delete();
        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Xóa Thành công Sản phẩm Giảm Giá!",
            "data" => $san_pham_sale
        ]);
    }

    //tìm kiếm, lọc
    public function search(Request $request)
    {
        $query = SanPhamSale::query();
        if ($search = $request->input('search')) {
            $query->whereRaw("id_sale_off LIKE '%" . $search . "%'")
                ->orWhereRaw("id_san_pham LIKE '%" . $search . "%'")
                ->orWhereRaw("gia_sale LIKE '%" . $search . "%'");
        }
        if ($sort = $request->input('sort')) {
            $query->orderBy('id_san_pham', $sort)
                ->orderBy('id_sale_off', $sort);
        }     
        $perPage = 8;
        $page = $request->input('page', 1);
        $total = $query->count();
        $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();
        return [          
            'data' => $result,
            // trả về kết quả
            'total' => $total,
            // tổng số kết quả
            'page' => $page,
            // số trang
            'last_page' => ceil($total / $perPage) // trang cuối
        ];
        // return $query->get();
    }
}