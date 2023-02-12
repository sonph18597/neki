<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoes;
use App\Http\Requests\ShoesRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class ShoesController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }
    public function index()
    {
        $shoes = new Shoes();
        $this->v['lists'] = $shoes->loadListWithPager();
        $this->v['_title'] = 'shoes';
        return view('shoes.index', $this->v);
    }
    public function add(ShoesRequest $request)
    {
        $this->v['_title'] = "Add";
        $method_route = 'Router_BackEnd_Shoes_Add';
        if ($request->isMethod('post')) {
            $param = [];
            $param['cols'] = $request->post();
            unset($param['cols']['_token']);
            //upload file
            if ($request->hasFile('img_list') && $request->file('img_list')->isValid()) {
                $param['cols']['list_img'] = $this->uploadFile($request->file('img_list'));
            }
            //
            $modelShoes = new Shoes();
            $res =  $modelShoes->saveNew($param);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới thành công');
            } else {
                Session::flash('error', 'Lỗi thêm mới');
                return redirect()->route($method_route);
            }
        }
        return view('shoes.add', $this->v);
    }
    public function detail($id)
    {
        $this->v['_title'] = "Chi tiết sản phẩm";
        $shoes = new Shoes();
        $objItem = $shoes->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('shoes.detail', $this->v);
    }
    public function update($id, Request $request)
    {
        $method_route = 'Router_BackEnd_Shoes_Detail';
        $param = [];
        $param['cols'] = $request->post();
        unset($param['cols']['_token']);
        if ($request->hasFile('img_list') && $request->file('img_list')->isValid()) {
            $param['cols']['list_img'] = $this->uploadFile($request->file('img_list'));
        }
        $shoes = new Shoes();
        $objItem = $shoes->loadOne($id);
        $param['cols']['id'] = $id;
        if (!is_null($param['cols']['id_prod_sale'])) {
            $param['cols']['id_prod_sale'] = Hash::make($param['cols']['id_prod_sale']);
        }
        $res = $shoes->saveUpdate($param);
        if ($res == null) {
            return redirect()->route($method_route, ['id' => $id]);
        } elseif ($res = 1) {
            Session::flash('success', 'Cập nhật bản ghi ' . $objItem->id . ' thành công');
            return redirect()->route($method_route, ['id' => $id]);
        } else {
            Session::flash('error', 'Lỗi cập nhật bản ghi ' . $objItem->id);
            return redirect()->route($method_route, ['id' => $id]);
        }
    }
    public function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('img', $fileName, 'public');
    }
    public function destroy($id)
    {
        $shoes = Shoes::destroy($id);
        return redirect('Shoes');
    }
}
