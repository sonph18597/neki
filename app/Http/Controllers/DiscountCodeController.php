<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCode;
use App\Http\Requests\DiscountCodeRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddDiscountCodeRequest;
use App\Http\Requests\GetDiscountCodeRequest;
use App\Http\Requests\UpdateDiscountCodeRequest;
use Illuminate\Http\JsonResponse;

class DiscountCodeController extends Controller
{
    public function getAllDiscountCode(GetDiscountCodeRequest $request){
        $model = new DiscountCode();
        $discountcode = $model->loadListWithPager($request->input());
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $discountcode
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function addDiscountCode(AddDiscountCodeRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $discountcode = new DiscountCode();
        $discountcode->saveNew($params);
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

    public function updateDiscountCode($id, UpdateDiscountCodeRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['id'] = $id;
        unset( $params['cols']['_token']);
        $discountcode = new DiscountCode();
        $discountcode->saveUpdate($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'id' => $discountcode->id
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function getOneDiscountCode($id){
        $model = new DiscountCode();
        $discountcode = $model->loadOne($id);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'discountcode' => $discountcode,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
    public function deleteDiscountCode($id)
    {
        $discountcode = DiscountCode::find($id);
        if (!$discountcode) {
            return response()->json(['error' => 'DiscountCode này không tồn tại'], 404);
        }
        $discountcode->delete();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'discountcode' => $discountcode,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
