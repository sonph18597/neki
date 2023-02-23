<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleOff;
use Dotenv\Exception\ValidationException;



class SaleOffController extends Controller
{

 
    public function index()    // show mã giảm giá - sale-off    
    {
        $sale_off = SaleOff::paginate();  // phân trang
        // return (new SanPhamSale($sanphamsale))->response();
        return response()->json(SaleOff::all());
    }


    // Thêm sale_off
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'ten' => 'required|max:255', //tối đa 255 kí tự
                'mo_ta' => 'required|max:255',
                'phan_tram' => 'integer|required|between:1,100', // xác thực số phải nằm giữa 1-100
                'time_start' => 'required', // định dạng |date_format:Y-m-d|after_or_equal:now
                'time_end' => 'required'  // |date_format:Y-m-d|after_or_equal:from
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
        return SaleOff::create($request->all());
        return response()->json(['message' => 'Thêm Mã Sale Off Thành công!']);    
    }


    // lấy ra san_pham_sale
    public function show($id)
    {
        $sale_off = SaleOff::find($id);

        if (!$sale_off) {
            return response()->json(['error' => 'Không tìm thấy Mã Sale Off có ID là ' . $id . '!'], 404);
        }

        return response()->json($sale_off);
    }


    // update sale_off
    public function update(Request $request, $id){
        $sale_off = SaleOff::find($id);

        if (!$sale_off) {
            return response()->json(['error' => 'Không tìm thấy Mã Sale Off'], 404);
        }

        $validatedData = $request->validate([
            'ten' => 'required|max:255', // tối đa 255 kí tự
            'mo_ta' => 'required|max:255',
            'phan_tram' => 'min:1,max:100', // xác thực số phải nằm giữa 1-100
            'time_start' => 'nullable|date',
            'time_end' => 'nullable|date'
        ]);
        $sale_off->update($validatedData, $request->all());
        // return SaleOff::update($request->all());
        return response()->json(['message' => 'Cập nhật Thành công!']);    
          
    }


    // delete sale_off - mã giảm giá
    public function destroy($id)
    {
        $sale_off = SaleOff::find($id);

        if (!$sale_off) {
            return response()->json(['error' => 'Không tìm thấy Mã Sale Off!'], 404);
        }
        $sale_off->delete();

        return response()->json(['message' => 'Xóa thành công Mã Sale Off']);
    }
   
}
