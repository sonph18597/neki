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
    public function index() // show SẢN PHẦM SALE   

    {
        
        // return (new SanPhamSale($sanphamsale))->response();
        $san_pham_sale = SanPhamSale::all();
        $san_pham_sale = SanPhamSale::paginate(8); // phân trang
        // $data = Http::get('http://127.0.0.1:8000/api/sale-off/')->json();
        $data = response()->json([
            "success" => true,
            "status_code"=>200,
            "title" => "Danh sách Sản Phẩm Giảm Giá",
            "data" => $san_pham_sale
        ]);
        return view('admin.san_pham_sale.index',['data'=>$san_pham_sale]);
    }


    // add san_pham_sale
    // public function store(Request $request)
    // {
    //     try {
    //         $this->validate($request, [
    //             'id_sale_off' => 'required|unique:san_pham_sale', // trường ko được tồn tại trong DB
    //             'id_san_pham' => 'required',
    //             'gia_sale' => 'required|regex:/^\d*(\.\d{3})?$/', // làm tròn sau dấu . có 3 chữ số,
    //             'so_luong' => 'required|regex:/^\d*(\.\d{3})?$/',
    //         ]);
    //     } catch (ValidationException $e) {
    //         return response()->json(['error' => $e->getMessage()], 400);
    //     }

    //     return SanPhamSale::create($request->all());
    //     return response()->json(['message' => 'Thêm Sản Phẩm Sale Thành công!']);    
    // }
    public function addSanPhamSale(Request $request)
    {
        if ($request->isMethod('post')) {
        $san_pham_sale = $request->all();
        $validator = Validator::make($san_pham_sale, [
            'id_sale_off' => 'required|unique:san_pham_sale',
            // trường ko được tồn tại trong DB
            'id_san_pham' => 'required',
            'gia_sale' => 'required|regex:/^\d*(\.\d{3})?$/',
            // làm tròn sau dấu . có 3 chữ số,
            'so_luong' => 'required|regex:/^\d*(\.\d{3})?$/',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        // $san_pham_sale = SanPhamSale::create($san_pham_sale);
        // return response()->json([
        //     "success" => true,
        //     "message" => "Thêm Sản Phẩm Giảm Giá Thành Công!",
        //     "data" => $san_pham_sale
        // ]);
        
        if ($san_pham_sale = SanPhamSale::create($san_pham_sale)) {
            Session::flash('success', 'Thêm mới thành công!');
        }            
        else {
            Session::flash('error', 'Lỗi thêm mới người dùng!');
        }
        }
        return view('admin.san_pham_sale.add');
    }


    // lấy ra san_pham_sale
    // public function show($id)
    // {
    //     $san_pham_sale = SanPhamSale::find($id);

    //     if (!$san_pham_sale) {
    //         return response()->json(['error' => 'Không tìm thấy Sản phẩm Sale có ID là ' . $id . '!'], 404);
    //     }

    //     return response()->json($san_pham_sale);
    // }
    public function listSanPhamSale($id)
    {
        $san_pham_sale = SanPhamSale::find($id);
        if (is_null($san_pham_sale)) {
            return $this->sendError('Không tìm thấy Sản phẩm giảm giá!');
        }
        return response()->json([
            "success" => true,
            "message" => "Đã tìm thành công Sản phẩm giảm giá!",
            "data" => $san_pham_sale
        ]);
    }




    // update san_pham_sale
    // public function update(Request $request, $id){
    //     $san_pham_sale = SanPhamSale::find($id);

    //     if (!$san_pham_sale) {
    //         return response()->json(['error' => 'Không tìm thấy Sản phẩm Sale'], 404);
    //     }

    //     $validatedData = $request->validate([
    //         'id_sale_off' => 'sometimes|required|unique:san_pham_sale', // trường ko được tồn tại trong DB //
    //         'id_san_pham' => 'sometimes|required',  // sometimes: chỉ được xác thực khi nó tồn tại 
    //         'gia_sale' => 'sometimes|required|regex:/^\d*(\.\d{3})?$/', // làm tròn sau dấu . có 3 chữ số,
    //         'so_luong' => 'sometimes|required|regex:/^\d*(\.\d{3})?$/',
    //     ]);
    //     $san_pham_sale->update($validatedData, $request->all());
    //     // return SanPhamSale::update($request->all());
    //     return response()->json(['message' => 'Cập nhật Thành công!']);    
    // }
    public function updateSanPhamSale(Request $request, SanPhamSale $update_san_pham_sale)
    {
        $san_pham_sale = $request->all();
        $validator = Validator::make($san_pham_sale, [
            'id_sale_off' => 'sometimes|required',
            // trường ko được tồn tại trong DB //
            'id_san_pham' => 'sometimes|required',
            // sometimes: chỉ được xác thực khi nó tồn tại 
            'gia_sale' => 'sometimes|required|regex:/^\d*(\.\d{3})?$/',
            // làm tròn sau dấu . có 3 chữ số,
            'so_luong' => 'sometimes|required|regex:/^\d*(\.\d{3})?$/',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $update_san_pham_sale->id_sale_off = $san_pham_sale['id_sale_off'];
        $update_san_pham_sale->id_san_pham = $san_pham_sale['id_san_pham'];
        $update_san_pham_sale->gia_sale = $san_pham_sale['gia_sale'];
        $update_san_pham_sale->so_luong = $san_pham_sale['so_luong'];
        $update_san_pham_sale->save();
        return response()->json([
            "success" => true,
            "message" => "Cập nhật Thành công Sản phẩm giảm giá",
            "data" => $san_pham_sale
        ]);
    }


    // delete san_pham_sale
    public function deleteSanPhamSale($id)
    {
        $san_pham_sale = SanPhamSale::find($id);

        if (!$san_pham_sale) {
            return response()->json(['error' => 'Không tìm thấy Sản phẩm!'], 404);
        }
        $san_pham_sale->delete();
        return response()->json([
            "success" => true,
            "message" => "Xóa Thành công Sản phẩm Sale!",
            "data" => $san_pham_sale
        ]);
        // return response()->json(['message' => 'Xóa thành công Sản phẩm Sale!']);
    }
}