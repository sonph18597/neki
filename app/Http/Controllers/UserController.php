<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //search user
    public function search(Request $request)
    {
        $search = $request['search'] ?? "";
        if($search != ""){
                $user = User::where('ten','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%")->get();
        }
        else{
            $user = User::all();
        }

    }

    public function index()
    {
       $user = User::all();
       $user = User::paginate(5);
       return response()->json([
            'status'=> true,
            'message'=>'User retrieved.',
            'data'=> $user
       ]);
    }

    //creat user
    public function store(Request $request)
    {
            $data = $request->validate([
                'ten' => 'required|string|max:255',
                'so_dien_thoai'=>'required',
                'email'=>'required|email',
                'password'=>'required|max:255',
                'id_dia_chi'=>'required',
                'role_id'=>'required',
                'gioi_tinh'=>'required',
                'anh'=>'required',
                'ngay_sinh'=>'required|date',
                'trang_thai'=>'required'
            ]);
            $users = User::create($data);
            return response()->json([
                'status'=> true,
                'message'=>'User created.',
                'data'=> $users
            ],201);
    }

    //Show user
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User không tồn tại'], 404);
        }
        return response()->json([
            "success" => true,
            "message" => "Success",
            "data" => $user
        ]);

    }

    //update user
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User có id '.$id.' không tồn tại'], 404);
        }

        $validatedData = $request->validate([
            'ten' => 'required|string|max:255',
            'email'=>'required|email',
            'so_dien_thoai'=>'required',
            'gioi_tinh'=>'required',
            'password'=>'required|max:255',
            'id_dia_chi'=>'required',
            'role_id'=>'required',
            'anh'=>'required',
            'ngay_sinh'=>'required|date',
            'trang_thai'=>'required'
        ]);

        $user->update($validatedData, $request->all());

        return response()->json([
            "success" => true,
            "message" => "Update Thanh Cong",
            "data" => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User không tồn tại'], 404);
        }
        $user->delete();

        return response()->json(['message' => 'Xóa thành công']);
    }
}
