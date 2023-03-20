<?php

namespace App\Http\Controllers;

use App\Http\Requests\addDonHang;
use App\Http\Requests\GetAllDonHangRequest;
use App\Models\DonHang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonHangController extends Controller
{
    public function getAllDonHang(GetAllDonHangRequest $request){
        $model = new DonHang();
        $donHang = $model->loadListWithPager($request->input());
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $donHang
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function addDonHang(addDonHang $request ){
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
                    'don_hang_id' => $donHang->id
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function updateDonHang($id, addDonHang $request ){
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

    public function deleteDonHang($id){
        $data = DB::table("category")->where('id',$id);
        $data->delete();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'don_hang_id' => $id
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
