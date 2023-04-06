<?php

namespace App\Http\Controllers;

use App\Models\SoLuongGia;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\GetSoLuongGiaRequest;
use App\Http\Requests\AddSoLuongGiaRequest;
use App\Http\Requests\UpdateSoLuongGiaRequest;

class SoLuongGiaController extends Controller{
    public function getAllSoLuongGia(GetSoLuongGiaRequest $request){
        $model = new SoLuongGia();
        $soLuongGia = $model->loadListWithPager($request->input());
        if($soLuongGia == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $soLuongGia
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function addSoLuongGia(AddSoLuongGiaRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $soLuongGia = new SoLuongGia();
        $soLuongGia->saveNew($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'id' => true,
                    'messages'=> "Add thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function updateSoLuongGia($id, UpdateSoLuongGiaRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['id'] = $id;
        unset( $params['cols']['_token']);
        $soLuongGia = new SoLuongGia();
        $soLuongGia->saveUpdate($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'id' => $soLuongGia->id,
                    'messages'=> "Update thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function getOneSoLuongGia($id){
        $model = new SoLuongGia();
        $soLuongGia = $model->loadOne($id);
        if($soLuongGia == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'soLuongGia' => $soLuongGia,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
    public function deleteSoLuongGia($id)
    {
        $soLuongGia = SoLuongGia::find($id);
        if (!$soLuongGia) {
            return response()->json(['error' => 'Không tồn tại'], 404);
        }
        $soLuongGia->delete();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'soLuongGia' => $soLuongGia,
                    'messages'=> "Xóa thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
