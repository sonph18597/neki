<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->v=[];
    }
    public function index(Request $request){
        $user = new User();
        $this->v['title']="ABC";
        $this->v['extParams']= $request->all();
        $this->v['list']=$user->loadListWithPager();
//        dd($this->v['list']);
        return view("admin.user.index", $this->v);
    }
}
