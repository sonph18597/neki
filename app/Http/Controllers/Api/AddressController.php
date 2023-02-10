<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        return response()->json(Address::all());
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'province' => 'required|max:255',
                'district' => 'required|max:255',
                'village' => 'required|max:255',
                'detail' => 'required|max:255'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $address = Address::create([
            'province' => $request->province,
            'district' => $request->district,
            'village' => $request->village,
            'detail' => $request->detail
        ]);

        return response()->json(['message' => 'Successfully created address!'], 201);
    }

    public function show($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['error' => 'The address with id ' . $id . ' could not be found.'], 404);
        }

        return response()->json($address);
    }

    public function update(Request $request, $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['error' => 'Address not found'], 404);
        }

        $validatedData = $request->validate([
            'province' => 'sometimes|required|max:255',
            'district' => 'sometimes|required|max:255',
            'village' => 'sometimes|required|max:255',
            'detail' => 'sometimes|required|max:255',
        ]);

        $address->update($validatedData);

        return response()->json(['message' => 'Successfully updated address!']);
    }

    public function destroy($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['error' => 'Address not found'], 404);
        }

        return response()->json(['message' => 'Successfully deleted address!']);
    }
}
