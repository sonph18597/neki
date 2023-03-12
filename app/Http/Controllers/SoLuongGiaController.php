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
        try {
            $this->validate($request, [
                'id_mau' => 'required',
                'id_size'=>'required',
                'so_luong'=>'required',
                'gia'=>'required',
                'anh'=>'required'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        return SoLuongGia::create($request->all());
        return response()->json(['message' => 'Tạo thành công']);
    }

    public function show($id)
    {
        $so_luong_gia = SoLuongGia::find($id);

        if (!$so_luong_gia) {
            return response()->json(['message' => 'Không tồn tại'], 404);
        }

        return response()->json($so_luong_gia);
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

        return response()->json(['message' => 'Update thành công']);
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
