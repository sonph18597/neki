<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAllDonHangRequest;
use App\Http\Requests\TongTienRequest;
use App\Models\DonHang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    public function tongTienDonHangCacThangTruoc(TongTienRequest $request)
    {    
        $thangdau =  $request->input('thang-dau');
        $thangcuoi =  $request->input('thang-cuoi');
        if($thangcuoi == null) {
            $thangcuoi = $thangdau;
        }
        if($thangdau == null) {
            $thangdau = $thangcuoi;
        }
        $model = new DonHang();
        $tien = $model->tongTienCacThangTruoc($thangdau,$thangcuoi);
        if($tien == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $tien
            ]
        ], JsonResponse::HTTP_OK);
    }
}
