<?php

namespace App\Http\Controllers;

use App\Models\SanPhamSale;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class SanPhamSaleController extends Controller
{
    //show
    public function index()
    {
        $sanphamsale = SanPhamSale::paginate();  // phân trang
        // return (new SanPhamSale($sanphamsale))->response();
        return response()->json(SanPhamSale::all());
    }


    // add san_pham_sale
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'id_sale_off' => 'required|unique:san_pham_sale', // trường ko được tồn tại trong DB
                'id_san_pham' => 'required',
                'gia_sale' => 'required|regex:/^\d*(\.\d{3})?$/', // làm tròn sau dấu . có 3 chữ số,
                'so_luong' => 'required|regex:/^\d*(\.\d{3})?$/',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return SanPhamSale::create($request->all());
        return response()->json(['message' => 'Thêm Sản Phẩm Sale Thành công!']);    
    }


    // lấy ra san_pham_sale
    public function show($id)
    {
        $sanphamsale = SanPhamSale::find($id);

        if (!$sanphamsale) {
            return response()->json(['error' => 'Không tìm thấy Sản phẩm Sale có ID là ' . $id . '!'], 404);
        }

        return response()->json($sanphamsale);
    }


    // update san_pham_sale
    public function update(Request $request, $id){
        $sanphamsale = SanPhamSale::find($id);

        if (!$sanphamsale) {
            return response()->json(['error' => 'Không tìm thấy Sản phẩm Sale'], 404);
        }

        $validatedData = $request->validate([
            'id_sale_off' => 'sometimes|required|unique:san_pham_sale', // trường ko được tồn tại trong DB //
            'id_san_pham' => 'sometimes|required',  // sometimes: chỉ được xác thực khi nó tồn tại 
            'gia_sale' => 'sometimes|required|regex:/^\d*(\.\d{3})?$/', // làm tròn sau dấu . có 3 chữ số,
            'so_luong' => 'sometimes|required|regex:/^\d*(\.\d{3})?$/',
        ]);
        $sanphamsale->update($validatedData, $request->all());
        // return SanPhamSale::update($request->all());
        return response()->json(['message' => 'Cập nhật Thành công!']);    
          
    }


    // delete san_pham_sale
    public function destroy($id)
    {
        $sanphamsale = SanPhamSale::find($id);

        if (!$sanphamsale) {
            return response()->json(['error' => 'Không tìm thấy Sản phẩm!'], 404);
        }
        $sanphamsale->delete();

        return response()->json(['message' => 'Xóa thành công Sản phẩm Sale!']);
    }
}
