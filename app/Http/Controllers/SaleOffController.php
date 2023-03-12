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
    public function index() // show mã giảm giá - sale-off    

    {
        // $sale_off = DB::table('sale_off')->simplePaginate(5); 
        // return (new SanPhamSale($sanphamsale))->response();
        $sale_off = SaleOff::all();
        $sale_off = SaleOff::paginate(8); // phân trang
        // $data = Http::get('http://127.0.0.1:8000/api/sale-off/')->json();
        $data = response()->json([
            "success" => true,
            "status_code"=>200,
            "title" => "Danh sách Mã Sale Off",
            "data" => $sale_off
        ]);
        return view('admin.sale_off.index',['data'=>$sale_off]);
    }


    // Thêm sale_off
    // public function store(Request $request)
    // {
    //     try {
    //         $this->validate($request, [
    //             'ten' => 'required|max:255', //tối đa 255 kí tự
    //             'mo_ta' => 'required|max:255',
    //             'phan_tram' => 'integer|required|between:1,100', // xác thực số phải nằm giữa 1-100
    //             'time_start' => 'required', // định dạng |date_format:Y-m-d|after_or_equal:now
    //             'time_end' => 'required'  // |date_format:Y-m-d|after_or_equal:from
    //         ]);
    //     } catch (ValidationException $e) {
    //         return response()->json(['error' => $e->getMessage()], 400);
    //     }
    //     return SaleOff::create($request->all());
    //     return response()->json(['message' => 'Thêm Mã Sale Off Thành công!']);    
    // }

    // public function addSaleOff(Request $request)
    // {
    //     $request->validate([
    //         'ten' => 'required|max:255',
    //         //tối đa 255 kí tự
    //         'mo_ta' => 'required|max:255',
    //         'phan_tram' => 'integer|required|between:1,100',
    //         // xác thực số phải nằm giữa 1-100
    //         'time_start' => 'required',
    //         // định dạng |date_format:Y-m-d|after_or_equal:now
    //         'time_end' => 'required' // |date_format:Y-m-d|after_or_equal:from
    //     ]);
    //     $sale_off = new SaleOff();
    //     $sale_off->ten = $request->input('ten');
    //     $sale_off->mo_ta = $request->input('mo_ta');
    //     $sale_off->phan_tram = $request->input('phan_tram');
    //     $sale_off->time_start = $request->input('time_start');
    //     $sale_off->time_end = $request->input('time_end');
    //     $sale_off->save();
    //     // SaleOff::created("User ID {$sale_off->id} created successfully.");
    //     return response()->json(['message' => 'Thêm Mã Sale Off Thành công!']);    
    //     // return SaleOff::create($request->all());     
    //     // return (new SaleOffController($sale_off))->response()->setStatusCode(response()->json(['sale_off' => $sale_off], 201));
    // }
    // public function expectsJson()
    // {
    //     return ($this->ajax() && ! $this->pjax() && $this->acceptsAnyContentType()) || $this->wantsJson();
    // }

    // Add sale off
    // public function addSaleOff(Request $request)
    // {
    //     $sale_off = $request->all();
    //     $validator = Validator::make($sale_off, [
    //         'ten' => 'required|max:255',
    //         //tối đa 255 kí tự
    //         'mo_ta' => 'required|max:255',
    //         'phan_tram' => 'integer|required|between:1,100',
    //         // xác thực số phải nằm giữa 1-100
    //         'time_start' => 'required',
    //         // định dạng |date_format:Y-m-d|after_or_equal:now
    //         'time_end' => 'required' // |date_format:Y-m-d|after_or_equal:from
    //     ]);
    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     }
    //     $sale_off = SaleOff::create($sale_off);
    //     return response()->json([
    //         "success" => true,
    //         "message" => "Sale Off created successfully.",
    //         "data" => $sale_off
    //     ]);
    //     return view('admin.sale_off.add',["data" => $sale_off]);
    // }
    public function addSaleOff(Request $request)
    {
        if ($request->isMethod('post')) {
        $sale_off = $request->all();
        $validator = Validator::make($sale_off, [
            'ten' => 'required|max:255',
            //tối đa 255 kí tự
            'mo_ta' => 'required|max:255',
            'phan_tram' => 'integer|required|between:1,100',
            // xác thực số phải nằm giữa 1-100
            'time_start' => 'required',
            // định dạng |date_format:Y-m-d|after_or_equal:now
            'time_end' => 'required' // |date_format:Y-m-d|after_or_equal:from
        ]);
        // $sale_off = SaleOff::create($sale_off);
        // return response()->json([
        //     "success" => true,
        //     "message" => "Sale Off created successfully.",
        //     "data" => $sale_off
        // ]);    
        
        if ($sale_off = SaleOff::create($sale_off)) {
            Session::flash('success', 'Thêm mới thành công!');
        }            
        else {
            Session::flash('error', 'Lỗi thêm mới người dùng!');
        }
        // Session::flash('success', 'Thêm mới thành công!');
        }
        return view('admin.sale_off.add');
    }


    // lấy ra sale_off
    // public function show($id)
    // {
    //     $sale_off = SaleOff::find($id);
    //     if (!$sale_off) {
    //         return response()->json(['error' => 'Không tìm thấy Mã Sale Off có ID là ' . $id . '!'], 404);
    //     }
    //     // return response()->json($sale_off);
    //     return response()->json(['sale_off' => $sale_off], 200);
    // }
    public function listSaleOff($id)
    {
        $sale_off = SaleOff::find($id);
        if (is_null($sale_off)) {
            return $this->sendError('Không tìm thấy Mã Sale Off!');
        }
        return response()->json([
            "status_code" =>200,
            "success" => true,
            "message" => "Đã tìm thành công Mã Sale Off!",
            "data" => $sale_off
        ]);
      
    }


    // update sale_off
    // public function update(Request $request, $id)
    // {
    //     $sale_off = SaleOff::find($id);
    //     if (!$sale_off) {
    //         return response()->json(['error' => 'Không tìm thấy Mã Sale Off'], 404);
    //     }
    //     $validatedData = $request->validate([
    //         'ten' => 'required|max:255',
    //         // tối đa 255 kí tự
    //         'mo_ta' => 'required|max:255',
    //         'phan_tram' => 'min:1,max:100',
    //         // xác thực số phải nằm giữa 1-100
    //         'time_start' => 'nullable|date',
    //         'time_end' => 'nullable|date'
    //     ]);
    //     $sale_off->update($validatedData, $request->all());
    //     // return SaleOff::update($request->all());
    //     return response()->json(['message' => 'Cập nhật Thành công!']);
    // }
    public function updateSaleOff(Request $request, SaleOff $update_sale_off)
    {
        $sale_off = $request->all();
        $validator = Validator::make($sale_off, [
            'ten' => 'required|max:255',
            // tối đa 255 kí tự
            'mo_ta' => 'required|max:255',
            'phan_tram' => 'min:1,max:100',
            // xác thực số phải nằm giữa 1-100
            'time_start' => 'nullable|date',
            'time_end' => 'nullable|date'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $update_sale_off->ten = $sale_off['ten'];
        $update_sale_off->mo_ta = $sale_off['mo_ta'];
        $update_sale_off->phan_tram = $sale_off['phan_tram'];
        $update_sale_off->time_start = $sale_off['time_start'];
        $update_sale_off->time_end = $sale_off['time_end'];
        $update_sale_off->save();
        return response()->json([
            "success" => true,
            "message" => "Cập nhật Thành công Mã giảm giá!",
            "data" => $sale_off
        ]);
    }


    // delete sale_off - mã giảm giá
    public function deleteSaleOff($id)
    {
        $sale_off = SaleOff::find($id);

        if (!$sale_off) {
            return response()->json(['error' => 'Không tìm thấy Mã Sale Off!'], 404);
        }
        $sale_off->delete();

        // return response()->json(['message' => 'Xóa thành công Mã Sale Off']);
        return response()->json([
            "success" => true,
            "message" => "Xóa Thành công Mã giảm giá!",
            "data" => $sale_off
        ]);
        return view('admin.sale_off.index',['data'=>$sale_off]);
    }

}