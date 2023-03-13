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
            "status_code"=>200,
            "title" => "Danh sách Sản Phẩm Giảm Giá",
            "data" => $san_pham_sale
        ]);
    }

    public function addSanPhamSale(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id_sale_off' => 'required|unique:san_pham_sale',  // trường ko được tồn tại trong DB
            'id_san_pham' => 'required',
            'gia_sale' => 'required|regex:/^\d*(\.\d{3})?$/', // làm tròn sau dấu . có 3 chữ số,
            'so_luong' => 'required|regex:/^\d*(\.\d{3})?$/',
        ]);
        if ($validator->fails()) {
            // return $this->sendError('Validation Error.', $validator->errors());
            return response()->json(["error" => 'Lỗi khi thêm, hãy thao tác lại'], 400);
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
            return response()->json(['error' => 'Không tìm thấy Sản Phẩm Giảm Giá có ID '.$id.''], 404);
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

    if (!$san_pham_sale) {
        return response()->json(['error' => 'Không tìm thấy Sản Phẩm Giảm Giá có ID '.$id.''], 404);
    }

    $validatedData = $request->validate([
        'id_sale_off' => 'sometimes|required',  // trường ko được tồn tại trong DB //
        'id_san_pham' => 'sometimes|required',  // sometimes: chỉ được xác thực khi nó tồn tại 
        'gia_sale' => 'sometimes|required|regex:/^\d*(\.\d{3})?$/', // làm tròn sau dấu . có 3 chữ số,
        'so_luong' => 'sometimes|required|regex:/^\d*(\.\d{3})?$/',
    ]);

    $san_pham_sale->update($validatedData);
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
            return response()->json(['error' => 'Không tìm thấy Sản phẩm Giảm Giá có ID '.$id.''], 404);
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
      public function filter(Request $request)
      {
          $search = $request['search'] ?? "";
          if($search != ""){
                  $san_pham_sale = SanPhamSale::where('name','LIKE',"%$search%")->get();
          }
          else{
              $san_pham_sale = SanPhamSale::all();
          } 
      }
}