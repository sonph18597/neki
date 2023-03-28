<?php

namespace App\Http\Controllers;

use App\Models\SoLuongGia;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\GetSoLuongGiaRequest;
use App\Http\Requests\AddSoLuongGiaRequest;
use App\Http\Requests\UpdateSoLuongGiaRequest;
use Illuminate\Http\Request;

//class SoLuongGiaController extends Controller
//{
//    public function index()
//    {
//        return response()->json(SoLuongGia::all());
//    }
//    public function store(Request $request)
//    {
//        $data = $request->validate([
//            'id_mau' => 'required',
//            'id_size'=>'required',
//            'so_luong'=>'required',
//            'gia'=>'required',
//            'anh'=>'required'
//        ]);
//        $soLuongGia = SoLuongGia::create($request->$data);
//        return response()->json([
//            'status'=> true,
//            'message'=>'User created.',
//            'data'=> $soLuongGia
//        ],201);
//
//    }
//
//    public function show($id)
//    {
//        $so_luong_gia = SoLuongGia::find($id);
//
//        if (!$so_luong_gia) {
//            return response()->json(['message' => 'Không tồn tại'], 404);
//        }
//
//        return response()->json([
//            "success" => true,
//            "message" => "Success",
//            "data" => $so_luong_gia
//        ]);
//    }
//
//
//    public function update(Request $request, $id)
//    {
//        $so_luong_gia = SoLuongGia::find($id);
//
//        if (!$so_luong_gia) {
//            return response()->json(['error' => 'Id '.$id.' không tồn tại'], 404);
//        }
//
//        $validatedData = $request->validate([
//            'id_mau' => 'required',
//            'id_size'=>'required',
//            'so_luong'=>'required',
//            'gia'=>'required',
//            'anh'=>'required'
//        ]);
//
//        $so_luong_gia->update($validatedData, $request->all());
//
//        return response()->json([
//            "success" => true,
//            "message" => "Update Thanh Cong",
//            "data" => $so_luong_gia
//        ]);
//    }
//
//    public function destroy($id)
//    {
//        $so_luong_gia = SoLuongGia::find($id);
//
//        if (!$so_luong_gia) {
//            return response()->json(['error' => 'ID không tồn tại'], 404);
//        }
//        $so_luong_gia->delete();
//
//        return response()->json(['message' => 'Xóa thành công']);
//    }
//}
class SoLuongGiaController extends Controller{
    public function getAllSoLuongGia(GetSoLuongGiaRequest $request){
        $model = new SoLuongGia();
        $soLuongGia = $model->loadListWithPager($request->input());
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
                    'id' => $soLuongGia->id
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function getOneSoLuongGia($id){
        $model = new SoLuongGia();
        $soLuongGia = $model->loadOne($id);
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
            return response()->json(['error' => 'User không tồn tại'], 404);
        }
        $soLuongGia->delete();
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
}
