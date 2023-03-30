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
    //
    public function index()
    {
        return response()->json(Size::all());
    }
    public function pagination() {
        return response()->json(Shoes::paginate(8));
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'size' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage('BAD REQUEST')], 400);
        }

        $size = Size::create([
            'size' => $request->size,

        ]);

        return response()->json(['message' => 'CCREATE SUCCESS'], 201);
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

        $validatedData = $request->validate([
                'size' => 'sometimes|required',

        ]);

        $size->update($validatedData);

        return response()->json(['message' => 'UPDATES SUCCESS']);
    }

    public function delete($id)
    {
        $size = Size::find($id);

        if (!$size) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }
        $size->delete();

        return response()->json(['message' => 'DELETES SUCCESS']);
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
