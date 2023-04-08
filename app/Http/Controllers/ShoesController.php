<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddShoesRequest;
use App\Http\Requests\GetShoesRequest;
use App\Http\Requests\UpdateShoesRequest;
use Illuminate\Http\JsonResponse;


class ShoesController extends Controller
{
    public function getAllShoes(GetShoesRequest $request){
        $model = new Shoes();
        $shoes = $model->loadListWithPager($request->input());
        if($shoes == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' =>$shoes
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function addShoes(AddShoesRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $shoes = new Shoes();
        $shoes->saveNew($params);
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

    public function updateShoes($id, UpdateShoesRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['id'] = $id;
        unset( $params['cols']['_token']);
        $shoes = new Shoes();
        $shoes->saveUpdate($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'id' => $shoes->id,
                    'messages'=> "Update thành công"

                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function getOneShoes($id){
        $model = new Shoes();
        $shoes = $model->loadOne($id);
        if($shoes == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'shoes' => $shoes,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
    public function deleteShoes($id)
    {
        $shoes = Shoes::find($id);
        if (!$shoes) {
            return response()->json(['error' => 'Sản phẩm này không tồn tại'], 404);
        }
        $shoes->delete();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'shoes' => $shoes,
                    'messages'=> "Delete thành công"

                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
