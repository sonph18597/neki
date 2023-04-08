<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAnhRequest;
use App\Http\Requests\GetAnhRequest;
use App\Http\Requests\UpdateAnhRequest;
use App\Models\Anh;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class AnhController extends Controller
{

    public function getAllAnh()
    {
        $anh = Anh::all();
        $anh = Anh::paginate(8); // phân trang
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $anh,
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function addAnh(AddAnhRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        if ($request->hasFile('url') && $request->file('url')->isValid())
        {
            $params['cols']['images'] = [ $this->uploadFile($request->file('url')) ];
        }
        $anh = new Anh();
        $anh->saveNew($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'id' => true,
                    'messages'=> "Thêm Ảnh thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function updateAnh($id, UpdateAnhRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['id'] = $id;
        unset( $params['cols']['_token']);
        $anh = new Anh();
        $anh->saveUpdate($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'id' => $anh->id,
                    'messages'=> "Update Ảnh thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function getOneAnh($id){
        $model = new Anh();
        $anh = $model->loadOne($id);
        if($anh == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'anh' => $anh,

                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
    public function deleteAnh($id)
    {
        $anh = Anh::find($id);
            // ->where('deleted_at', 'LIKE', '%null%');
        if (!$anh) {
            return response()->json(['error' => 'Ảnh sản phẩm này không tồn tại'], 404);
        }
        $anh->delete();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'anh' => $anh,
                    'messages'=> "Xóa Ảnh thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
