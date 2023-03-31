<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DiaChi;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class DiaChiController extends Controller
{

    public function index(REquest $request)
    {   
        if (!$request->has('limit')){
            return response()->json(DiaChi::all());
        }
        $limit = $request->get('litmit');
        $diaChi = DiaChi::paginate($limit);
        $diaChi->appends(request()->query())->links();

        return response()->json($diaChi);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tinh_thanh_pho' => 'required|max:255',
            'quan_huyen' => 'required|max:255',
            'phuong_xa' => 'required|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $diaChi = DiaChi::create($request->all());
            return response()->json(['message' => 'Successfully created DiaChi!'], 201);
        }
        catch (QueryException $e) {
            return response()->json(['message' => $e], 400);
        }
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

        $validator = Validator::make($request->all(), [
            'tinh_thanh_pho' => 'max:255',
            'quan_huyen' => 'max:255',
            'phuong_xa' => 'max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $diaChi->update($request->all());
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

    public function search(Request $request){
        $findName = '';
        $dataSearch = '';
        if($request->has('tinh_thanh_pho')){
            $findName = 'tinh_thanh_pho';
            $dataSearch = $request->query('tinh_thanh_pho');
        }else if($request->has('quan_huyen')){
            $findName = 'quan_huyen';
            $dataSearch = $request->query('quan_huyen');
        }else if($request->has('phuong_xa')){
            $findName = 'phuong_xa';
            $dataSearch = $request->query('phuong_xa');
        }else if($request->has('chi_tiet')){
            $findName = 'chi_tiet';
            $dataSearch = $request->query('chi_tiet');
        }
        if ($findName == '') {
            return response()->json((['message' => 'Not found']), 404);
        }

        $dataFind = DiaChi::where($findName, 'like', '%'.$dataSearch.'%')->get();

        if ($dataFind->isEmpty()) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($dataFind);

    }
}
