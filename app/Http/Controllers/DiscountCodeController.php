<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCode;
use App\Http\Requests\DiscountCodeRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
class DiscountCodeController extends Controller
{
    public function index()
    {
        $discountcode = DiscountCode::all();
        $discountcode = DiscountCode::paginate(8);
        return response()->json($discountcode);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'discount_code' => 'required|max:255',
                'exclude_prod' => 'required|max:255',
                'include_prod' => 'required|max:255',
                'condition_type' => 'required|max:255',
                'type_discount' => 'required|max:255',
                'discount_number' => 'required',
                'limits' => 'required',
                'time_start' => 'required',
                'time_end' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => '400 Bad Request',
                'errors' => $validator->errors(),
            ], 400);
        }
        $discountcode = DiscountCode::create($input);
        return response()->json($discountcode);
    }

    public function show($id)
    {
        $discountcode = DiscountCode::find($id);

        if (!$discountcode) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }

        return response()->json($discountcode);
    }

    public function update(Request $request, $id)
    {
        $discountcode = DiscountCode::find($id);

        if (!$discountcode) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }

        $validator = Validator::make($input,[
            'discount_code' => 'required|max:255',
                'exclude_prod' => 'required|max:255',
                'include_prod' => 'required|max:255',
                'condition_type' => 'required|max:255',
                'type_discount' => 'required|max:255',
                'discount_number' => 'required',
                'limits' => 'required',
                'time_start' => 'required',
                'time_end' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => '400 Bad Request',
                'errors' => $validator->errors(),
            ], 400);
        }

        $discountcode->update($input);
        return response()->json($discountcode);
        }
    public function delete($id)
    {
        $discountcode = DiscountCode::find($id);

        if (!$discountcode) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }
        $discountcode->delete();

        return response()->json($discountcode);
    }
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $DiscountCode = DiscountCode::query()
            ->where('discount_code', 'LIKE', "%{$search}%")
            ->orWhere('exclude_prod', 'LIKE', "%{$search}%")
            ->orWhere('include_prod', 'LIKE', "%{$search}%")
            ->orWhere('type_discount', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('search', compact('discountcode'));
    }
}
