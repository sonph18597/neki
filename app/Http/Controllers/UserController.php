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
        if($user == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
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
                    'messages'=> "Add User thành công"
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
                    'id' => $user->id,
                    'messages'=> "Update User thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    public function getOneUser($id){
        $model = new User();
        $user = $model->loadOne($id);
        if($user == null) {
            return response()->json([ 'message' => "Không có dữ liệu"  ]);
        }
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
        $user = User::find($id)
        ->where('deleted_at', 'LIKE', '%null%');
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
                    'messages'=> "Xóa User thành công"
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
