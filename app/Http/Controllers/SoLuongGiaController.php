<?php

namespace App\Http\Controllers;

use App\Models\SoLuongGia;
use Illuminate\Http\Request;

class SoLuongGiaController extends Controller
{
    public function index()
    {
        return response()->json(SoLuongGia::all());
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_mau' => 'required',
            'id_size'=>'required',
            'so_luong'=>'required',
            'gia'=>'required',
            'anh'=>'required'
        ]);
        $soLuongGia = SoLuongGia::create($request->$data);
        return response()->json([
            'status'=> true,
            'message'=>'User created.',
            'data'=> $soLuongGia
        ],201);

    }

    public function show($id)
    {
        $so_luong_gia = SoLuongGia::find($id);

        if (!$so_luong_gia) {
            return response()->json(['message' => 'Không tồn tại'], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Success",
            "data" => $so_luong_gia
        ]);
    }


    public function update(Request $request, $id)
    {
        $so_luong_gia = SoLuongGia::find($id);

        if (!$so_luong_gia) {
            return response()->json(['error' => 'Id '.$id.' không tồn tại'], 404);
        }

        $validatedData = $request->validate([
            'id_mau' => 'required',
            'id_size'=>'required',
            'so_luong'=>'required',
            'gia'=>'required',
            'anh'=>'required'
        ]);

        $so_luong_gia->update($validatedData, $request->all());

        return response()->json([
            "success" => true,
            "message" => "Update Thanh Cong",
            "data" => $so_luong_gia
        ]);
    }

    public function destroy($id)
    {
        $so_luong_gia = SoLuongGia::find($id);

        if (!$so_luong_gia) {
            return response()->json(['error' => 'ID không tồn tại'], 404);
        }
        $so_luong_gia->delete();

        return response()->json(['message' => 'Xóa thành công']);
    }
}
