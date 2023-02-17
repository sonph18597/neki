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
                'password'=>'required',
                'so_dien_thoai'=>'required',
                'gioi_tinh'=>'required',
                'ngay_sinh'=>'required'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        $user = User::create([
            'ten' => $request->ten,
            'email' => $request->email,
            'password' => $request->password,
            'so_dien_thoai' => $request->so_dien_thoai,
            'gioi_tinh'=> $request->gioi_tinh,
            'ngay_sinh'=> $request->ngay_sinh
        ]);

        return response()->json(['message' => 'Tạo User thành công'], 201);
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
            'password'=>'required',
            'so_dien_thoai'=>'required',
            'gioi_tinh'=>'required',
            'ngay_sinh'=>'required'
        ]);

        $user->update($validatedData);

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
