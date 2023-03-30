<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
class SizeController extends Controller
{
    public function index()
    {
        $size = Size::all();
        $size = Size::paginate(8);
        return response()->json($size);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'size' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => '400 Bad Request',
                'errors' => $validator->errors(),
            ], 400);
        }
        $size = Size::create($input);
        return response()->json($size);
    }

    public function show($id)
    {
        $size = Size::find($id);

        if (!$size) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }

        return response()->json($size);
    }

    public function update(Request $request, $id)
    {
        $size = Size::find($id);

        if (!$size) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }

        $validator = Validator::make($input,[
            'size' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => '400 Bad Request',
                'errors' => $validator->errors(),
            ], 400);
        }

        $size->update($input);
        return response()->json($size);
        }

    public function delete($id)
    {
        $size = Size::find($id);

        if (!$size) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }
        $size->delete();

        return response()->json($size);
    }
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $size = Size::query()
            ->where('size', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('search', compact('size'));
    }
}
