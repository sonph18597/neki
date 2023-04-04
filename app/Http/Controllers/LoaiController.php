<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLoaiRequest;
use App\Http\Requests\GetLoaiRequest;
use App\Http\Requests\UpdateLoaiRequest;
use App\Models\Loai;
use Illuminate\Http\JsonResponse;

class LoaiController extends Controller
{
    public function getAllLoai(GetLoaiRequest $request){
        $model = new Loai();
        $loai = $model->loadListWithPager($request->input());
        if($loai == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $loai
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function addLoai(AddLoaiRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $loai = new Loai();
        $loai->saveNew($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'id' => true,
                    'messages'=> "Add Loại thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function updateLoai($id, UpdateLoaiRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['id'] = $id;
        unset( $params['cols']['_token']);
        $loai = new Loai();
        $loai->saveUpdate($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'id' => $loai->id,
                    'messages'=> "Update Loại thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function getOneLoai($id){
        $model = new Loai();
        $loai = $model->loadOne($id);
        if($loai == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'loai' => $loai,

                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
    public function deleteLoai($id)
    {
        $loai = Loai::find($id)
            ->where('deleted_at', 'LIKE', '%null%');
        if (!$loai) {
            return response()->json(['error' => 'Loại sản phẩm này không tồn tại'], 404);
        }
        $loai->delete();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'loai' => $loai,
                    'messages'=> "Xóa Loại thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
