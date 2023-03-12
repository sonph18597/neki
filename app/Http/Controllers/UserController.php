<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'ten' => 'required',
                'email'=>'required|email',
                'so_dien_thoai'=>'required',
                'gioi_tinh'=>'required',
                'password'=>'required',
                'id_dia_chi'=>'required',
                'role_id'=>'required',
                'anh'=>'required',
                'ngay_sinh'=>'required',
                'trang_thai'=>'required'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        return User::create($request->all());
        return response()->json(['message' => 'Tạo User thành công']);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User không tồn tại'], 404);
        }

        return response()->json($user);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User có id '.$id.' không tồn tại'], 404);
        }

        $validatedData = $request->validate([
            'ten' => 'required',
            'email'=>'required|email',
            'so_dien_thoai'=>'required',
            'gioi_tinh'=>'required',
            'password'=>'required',
            'id_dia_chi'=>'required',
            'role_id'=>'required',
            'anh'=>'required',
            'ngay_sinh'=>'required',
            'trang_thai'=>'required'
        ]);

        $user->update($validatedData, $request->all());

        return response()->json(['message' => 'Update thành công']);
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
