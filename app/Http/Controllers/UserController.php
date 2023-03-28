<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\GetUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class UserController extends Controller{
    public function getAllUser(GetUserRequest $request){
        $model = new User();
        $user = $model->loadListWithPager($request->input());
//        var_dump($user);die;
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $user
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function addUser(AddUserRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $user = new User();
        $user->saveNew($params);
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

    public function updateUser($id, UpdateUserRequest $request ){
        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['id'] = $id;
        unset( $params['cols']['_token']);
        $user = new User();
        $user->saveUpdate($params);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'id' => $user->id
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function getOneUser($id){
        $model = new User();
        $user = $model->loadOne($id);
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'user' => $user,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User không tồn tại'], 404);
        }
        $user->delete();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    'user' => $user,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
