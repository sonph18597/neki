<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MauSac;
use Illuminate\Validation\ValidationException;

class MauSacController extends Controller
{

    public function index()
    {
        return response()->json(MauSac::all());
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'ten_mau' => 'required|unique:mau_sac|max:255'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        $color = new MauSac();
        $color->ten_mau = $request->ten_mau;
        $color->save();

        // $color = Color::create([
        //     'color_name' => $request->color_name
        // ]);

        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_CREATED,
            'contents' => [
                'entries' => $color
            ]
        ], JsonResponse::HTTP_CREATED);
    }


    public function show(Request $request, $id)
    {
        $color = MauSac::find($id);

        if (!$color) {
            return response()->json(['message' => 'Color not found'], 404);
        }

        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $color
            ]
        ], JsonResponse::HTTP_OK);
    }


    public function update(Request $request, $id)
    {
        $color = MauSac::find($id);

        if (!$color) {
            return response()->json(['message' => 'The color with id '.$id.' could not be found.'], 404);
        }

        try {
            $this->validate($request, [
                'ten_mau' => 'required|unique:mau_sac|max:255'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        $color->ten_mau = $request->input('ten_mau');
        $color->save();

        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $color
            ]
        ], JsonResponse::HTTP_OK);
    }


    public function destroy($id)
    {

        $color = MauSac::find($id);

        if (!$color) {
            return response()->json(['message' => 'The color with id '.$id.' could not be found.'], 404);
        }
        $color->delete();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => $color
            ]
        ], JsonResponse::HTTP_OK);
    }
}
