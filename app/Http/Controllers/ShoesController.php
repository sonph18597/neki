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
        $shoes = Shoes::paginate(8)
        ->where('deleted_at', 'LIKE', '%null%');
            return response()->json(['data' => $shoes]);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|max:255',
                'id_prod_sale' => 'required',
                'id_type' => 'required',
                'description' => 'required|max:255',
                'list_variant' => 'required|max:255',
                'min_price' => 'required',
                'max_price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => '400 Bad Request',
                'errors' => $validator->errors(),
            ], 400);
        }
        $shoes = Shoes::create($input);
            return response()->json(['data' => $shoes]);
    }

    public function show($id)
    {
        $shoes = Shoes::find($id);

        if (!$shoes) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }

            return response()->json(['data' => $shoes]);
    }

    public function update(Request $request, $id)
    {
        $shoes = Shoes::find($id);

        if (!$shoes) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }

        $validator = Validator::make($input,[
            'name' => 'required|max:255',
                'id_prod_sale' => 'required',
                'id_type' => 'required',
                'description' => 'required|max:255',
                'list_variant' => 'required|max:255',
                'min_price' => 'required',
                'max_price' => 'required',
                'deleted_at'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => '400 Bad Request',
                'errors' => $validator->errors(),
            ], 400);
        }

        $shoes->update($input);
            return response()->json(['data' => $shoes]);
        }

    public function delete($id)
    {
        $shoes = Shoes::find($id)
        ->where('deleted_at', 'LIKE', '%null%');

        if (!$shoes) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }
        $shoes->delete();

            return response()->json(['data' => $shoes]);
    }


    public function search(Request $request){
        $search = $request->input('search');

        $shoes = Shoes::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('id_type', 'LIKE', "%{$search}%")
            ->get();

            return response()->json(['data' => $shoes]);
        }
}
