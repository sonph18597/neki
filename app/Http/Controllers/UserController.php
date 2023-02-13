<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function getUser(){
    $model = new User();
    $user = $model->loadListWithPager();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $user
            ]
        ], JsonResponse::HTTP_OK);
    }
}
