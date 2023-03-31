<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAllDonHangRequest;
use App\Models\DonHang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    //
    public function donHangThangTruoc($sothang){
        $model = new DonHang();
        $donhang = $model->donHangThangTruoc($sothang);
        if($donhang == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $donhang
            ]
        ], JsonResponse::HTTP_OK);
    }
}
