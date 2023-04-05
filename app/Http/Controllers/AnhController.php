<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnhRequest;
use App\Models\Anh;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as FacadesFile;

class AnhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anh = Anh::all();
        $anh = Anh::paginate(5); // phân trang
        if($anh == null) {
            return response()->json([ 'message' => "Không có ảnh"  ]);
        }
        return response()->json([
            'result' => true,
            'title' => "Thêm Thành Công!",
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'data' =>[ 
                          $anh
                    ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function upload(AnhRequest $request)   //thêm ảnh
    {
        $anh = new Anh();

        $anh ->product_id = $request->product_id;
        $anh ->url = $request->url;
       
        $anh->save();
        return response()->json([
            'result' => true,
            'status_code' => JsonResponse::HTTP_OK,
            'contents' => [
                'entries' => [
                    "data" => $anh,
                ]
            ]
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
