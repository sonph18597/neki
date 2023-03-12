<?php

namespace App\Http\Controllers;

use App\Http\Requests\SanPhamDonHangRequest;
use App\Models\SanPhamDonHang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SanPhamDonHangController extends Controller
{
    //
    public function getSanPhamDonHang(){
        $model = new SanPhamDonHang();
        $sanPhamDonHang = $model->loadListWithPager();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $sanPhamDonHang
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function addSanPhamDonHang(SanPhamDonHangRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $sanPhamDonHang = new SanPhamDonHang();
        $sanPhamDonHang->saveNew($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'san_pham_don_hang_id' => $sanPhamDonHang->id
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function updateSanPhamDonHang($id, SanPhamDonHangRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['id'] = $id;
        unset( $params['cols']['_token']);
        $SanPhamDonHang = new SanPhamDonHang();
        $SanPhamDonHang->saveUpdate($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'san_pham_don_hang_id' => $SanPhamDonHang->id
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function deleteSanPhamDonHang($id){
        $data = DB::table("san_pham_don_hang")->where('id',$id);
        $data->delete();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'san_pham_don_hang_id' => $id
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
