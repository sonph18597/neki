<?php

namespace App\Http\Controllers;

use App\Http\Requests\addDonHang;
use App\Http\Requests\AddDonHangRequest;
use App\Http\Requests\GetAllDonHangRequest;
use App\Http\Requests\UpdateDonHangRequest;
use App\Models\DonHang;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
class DonHangController extends Controller
{
    public function getAllDonHang(GetAllDonHangRequest $request){
        $model = new DonHang();
        $donHang = $model->loadListWithPager($request->input());
        if($donHang == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $donHang
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function addDonHang(AddDonHangRequest $request ){
        $userId = Auth::user()->id;
        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['user_id'] = $userId;
        unset( $params['cols']['_token']);
        $donHang = new DonHang();
        $donHang->saveNew($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'don_hang_id' => true,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function updateDonHang($id, UpdateDonHangRequest $request ){
        $userId = Auth::user()->id;
        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['user_id'] = $userId;
        $params['cols']['id'] = $id;
        unset( $params['cols']['_token']);
        $donHang = new DonHang();
        $donHang->saveUpdate($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'don_hang_id' => $donHang->id
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function getOnedonHang($id){
       $model = new DonHang();
       $donhang = $model->loadOne($id);
       if($donhang == null) {
        return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'don_hang' => $donhang,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
