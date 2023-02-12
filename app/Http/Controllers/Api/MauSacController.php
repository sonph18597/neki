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
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $color = new MauSac();
        $color->ten_mau = $request->ten_mau;
        $color->save();

        // $color = Color::create([
        //     'color_name' => $request->color_name
        // ]);

        return response()->json(['message' => 'Successfully created color!'], 201);
    }


    public function show(Request $request, $id)
    {
        $color = MauSac::find($id);

        if (!$color) {
            return response()->json(['message' => 'Color not found'], 404);
        }

        return response()->json($color);
    }


    public function update(Request $request, $id)
    {
        $color = MauSac::find($id);

        if (!$color) {
            return response()->json(['error' => 'The color with id '.$id.' could not be found.'], 404);
        }

        try {
            $this->validate($request, [
                'ten_mau' => 'required|unique:mau_sac|max:255'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $color->ten_mau = $request->input('ten_mau');
        $color->save();

        return response()->json(['message' => 'Successfully updated color!']);
    }


    public function destroy($id)
    {

        $color = MauSac::find($id);

        if (!$color) {
            return response()->json(['error' => 'The color with id '.$id.' could not be found.'], 404);
        }
        $color->delete();
        return response()->json(['message' => 'Successfully deleted color!']);
    }
}
