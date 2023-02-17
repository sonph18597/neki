<?php

namespace App\Http\Controllers;

use App\Models\SoLuongGia;
use Illuminate\Http\Request;

class SoLuongGiaController extends Controller
{
    public function index()
    {
        return response()->json(SoLuongGia::all());
    }
}
