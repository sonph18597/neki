<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleOff;
use Dotenv\Exception\ValidationException;



class SaleOffController extends Controller
{

 
    public function index()    // show mã giảm giá - sale-off    
    {
        $saleoff = SaleOff::paginate();  // phân trang
        // return (new SanPhamSale($sanphamsale))->response();
        return response()->json(SaleOff::all());
    }


    // add sale_off
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
        $saleoff = SaleOff::find($id);

        if (!$saleoff) {
            return response()->json(['error' => 'Không tìm thấy Mã Sale Off có ID là ' . $id . '!'], 404);
        }

        return response()->json($saleoff);
    }


    // update sale_off
    public function update(Request $request, $id){
        $saleoff = SaleOff::find($id);

        if (!$saleoff) {
            return response()->json(['error' => 'Không tìm thấy Mã Sale Off'], 404);
        }

        $validatedData = $request->validate([
            'ten' => 'required|max:255', // tối đa 255 kí tự
            'mo_ta' => 'required|max:255',
            'phan_tram' => 'integer|required|between:1,100', // xác thực số phải nằm giữa 1-100
            'time_start' => 'nullable|date|date_format:H:i',
            'time_end' => 'nullable|date|date_format:H:i|after:time_start'
        ]);
        $saleoff->update($validatedData, $request->all());
        // return SanPhamSale::update($request->all());
        return response()->json(['message' => 'Cập nhật Thành công!']);    
          
    }


    // delete sale_off - mã giảm giá
    public function destroy($id)
    {
        $saleoff = SaleOff::find($id);

        if (!$saleoff) {
            return response()->json(['error' => 'Không tìm thấy Mã Sale Off!'], 404);
        }
        $saleoff->delete();

        return response()->json(['message' => 'Xóa thành công Mã Sale Off']);
    }
   
}
