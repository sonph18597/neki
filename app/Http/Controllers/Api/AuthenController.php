<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'ten' => 'required|max:255',
            'so_dien_thoai' => 'numeric|digits:10',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try{
            $user = new User();
            $user->fill($request->all());
            $user->password = Hash::make($request->password);

            $user->save();

            return response()->json([
                'result' => true,
                'status_code' => JsonResponse::HTTP_CREATED,
                'contents' => [
                    'entries' => $user
                ]
            ], JsonResponse::HTTP_CREATED);
        }
        catch (QueryException $e){
            return response()->json(["message" => $e], 400);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $user = JWTAuth::user();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'token' => $token,
                    'exp' => JWTAuth::factory()->getTTL(86400) * 60 * 24 , // tính toán thời gian hết hạn của token
                    'user' => $user
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
