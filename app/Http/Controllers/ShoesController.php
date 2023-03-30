<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoes;
use App\Http\Requests\ShoesRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class ShoesController extends Controller
{
    public function index()
    {
        return response()->json(Shoes::all());

    }
public function pagination() {
    return response()->json(Shoes::paginate(8));
}
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|max:255',
                'id_prod_sale' => 'required',
                'id_type' => 'required',
                'description' => 'required|max:255',
                'list_variant' => 'required|max:255',
                'min_price' => 'required',
                'max_price' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage('BAD REQUEST')], 400);
        }

        $shoes = Shoes::create([
            'name' => $request->name,
            'id_prod_sale' => $request->id_prod_sale,
            'id_type' => $request->id_type,
            'description' => $request->description,
            'list_variant' => $request->list_variant,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,

        ]);

        return response()->json(['message' => 'CCREATE SUCCESS'], 201);
    }

    public function show($id)
    {
        $shoes = Shoes::find($id);

        if (!$shoes) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }

        return response()->json($shoes);
    }

    public function update(Request $request, $id)
    {
        $shoes = Shoes::find($id);

        if (!$shoes) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }

        $validatedData = $request->validate([
                'name' => 'sometimes|required|max:255',
                'id_prod_sale' => 'sometimes|required',
                'id_type' => 'sometimes|required',
                'description' => 'sometimes|required|max:255',
                'list_variant' => 'sometimes|required|max:255',
                'min_price' => 'sometimes|required',
                'max_price' => 'sometimes|required',
        ]);

        $shoes->update($validatedData);

        return response()->json(['message' => 'UPDATES SUCCESS']);
    }

    public function delete($id)
    {
        $shoes = Shoes::find($id);

        if (!$shoes) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }
        $shoes->delete();

        return response()->json(['message' => 'DELETES SUCCESS']);
    }
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $shoes = Shoes::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('id_type', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('search', compact('shoes'));
    }
}