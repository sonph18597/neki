<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddSizeRequest;
use App\Http\Requests\GetSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use Illuminate\Http\JsonResponse;

class SizeController extends Controller
{
    public function getAllSize(GetSizeRequest $request){
        $model = new Size();
        $size = $model->loadListWithPager($request->input());
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $size
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function addSize(AddSizeRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $size = new Size();
        $size->saveNew($params);
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

    public function updateSize($id, UpdateSizeRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['id'] = $id;
        unset( $params['cols']['_token']);
        $size = new Size();
        $size->saveUpdate($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'id' => $size->id
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function getOneSize($id){
        $model = new Size();
        $size = $model->loadOne($id);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'size' => $size,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
    public function deleteSize($id)
    {
        $size = Size::find($id);
        if (!$size) {
            return response()->json(['error' => 'Size này không tồn tại'], 404);
        }
        $size->delete();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'size' => $size,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
