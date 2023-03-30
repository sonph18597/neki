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
        return response()->json(DiscountCode::all());
    }
    public function pagination() {
        return response()->json(Shoes::paginate(8));
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
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
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage('BAD REQUEST')], 400);
        }

        $DiscountCode = DiscountCode::create([
            'discount_code' => $request->discount_code,
            'exclude_prod' => $request->exclude_prod,
            'include_prod' => $request->include_prod,
            'condition_type' => $request->condition_type,
            'type_discount' => $request->type_discount,
            'discount_number' => $request->min_price,
            'limits' => $request->limits,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end
        ]);

        return response()->json(['message' => 'CCREATE SUCCESS'], 201);
    }

    public function show($id)
    {
        $DiscountCode = DiscountCode::find($id);

        if (!$DiscountCode) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }

        return response()->json($DiscountCode);
    }

    public function update(Request $request, $id)
    {
        $DiscountCode = DiscountCode::find($id);

        if (!$DiscountCode) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }

        $validatedData = $request->validate([
                'discount_code' => 'sometimes|required|max:255',
                'exclude_prod' => 'sometimes|required|max:255',
                'include_prod' => 'sometimes|required|max:255',
                'condition_type' => 'sometimes|required|max:255',
                'type_discount' => 'sometimes|required|max:255',
                'discount_number' => 'sometimes|required',
                'limits' => 'sometimes|required',
                'time_start' => 'sometimes|required',
                'time_end' => 'sometimes|required',
        ]);

        $DiscountCode->update($validatedData);

        return response()->json(['message' => 'UPDATES SUCCESS']);
    }

    public function delete($id)
    {
        $DiscountCode = DiscountCode::find($id);

        if (!$DiscountCode) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }
        $DiscountCode->delete();

        return response()->json(['message' => 'DELETES SUCCESS']);
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