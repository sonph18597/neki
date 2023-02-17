<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DiaChi;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class DiaChiController extends Controller
{
    public function index()
    {
        return response()->json(DiaChi::all());
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'tinh_thanh_pho' => 'required|max:255',
                'quan_huyen' => 'required|max:255',
                'phuong_xa' => 'required|max:255',
                'chi_tiet' => 'required|max:255'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $diaChi = DiaChi::create([
            'tinh_thanh_pho' => $request->tinh_thanh_pho,
            'quan_huyen' => $request->quan_huyen,
            'phuong_xa' => $request->phuong_xa,
            'chi_tiet' => $request->chi_tiet
        ]);

        return response()->json(['message' => 'Successfully created DiaChi!'], 201);
    }

    public function show($id)
    {
        $diaChi = DiaChi::find($id);

        if (!$diaChi) {
            return response()->json(['error' => 'The DiaChi with id ' . $id . ' could not be found.'], 404);
        }

        return response()->json($diaChi);
    }

    public function update(Request $request, $id)
    {
        $diaChi = DiaChi::find($id);

        if (!$diaChi) {
            return response()->json(['error' => 'DiaChi not found'], 404);
        }

        $validatedData = $request->validate([
            'tinh_thanh_pho' => 'sometimes|required|max:255',
            'quan_huyen' => 'sometimes|required|max:255',
            'phuong_xa' => 'sometimes|required|max:255',
            'chi_tiet' => 'sometimes|required|max:255',
        ]);

        $diaChi->update($validatedData);

        return response()->json(['message' => 'Successfully updated DiaChi!']);
    }

    public function destroy($id)
    {
        $diaChi = DiaChi::find($id);

        if (!$diaChi) {
            return response()->json(['error' => 'DiaChi not found'], 404);
        }
        $diaChi->delete();

        return response()->json(['message' => 'Successfully deleted DiaChi!']);
    }
}
