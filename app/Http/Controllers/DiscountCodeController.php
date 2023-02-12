<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCode;
use App\Http\Requests\DiscountCodeRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DiscountCodeController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }
    public function index()
    {
        $discountcode = new DiscountCode();
        $this->v['lists'] = $discountcode->loadListWithPager();
        $this->v['_title'] = 'shoes';
        return view('discountcode.index', $this->v);
    }
    public function add(DiscountCodeRequest $request)
    {
        $this->v['_title'] = "Add";
        $method_route = 'Router_BackEnd_DiscountCode_Add';
        if ($request->isMethod('post')) {
            $param = [];
            $param['cols'] = $request->post();
            unset($param['cols']['_token']);

            $modelDiscount = new DiscountCode();
            $res =  $modelDiscount->saveNew($param);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới thành công');
            } else {
                Session::flash('error', 'Lỗi thêm mới');
                return redirect()->route($method_route);
            }
        }
        return view('discountcode.add', $this->v);
    }
    public function detail($id)
    {
        $this->v['_title'] = "discount code";
        $discountcode = new DiscountCode();
        $objItem = $discountcode->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('discountcode.detail', $this->v);
    }
    public function update($id, Request $request)
    {
        $method_route = 'Router_BackEnd_DiscountCode_Detail';
        $param = [];
        $param['cols'] = $request->post();
        unset($param['cols']['_token']);

        $discountcode = new DiscountCode();
        $objItem = $discountcode->loadOne($id);
        $param['cols']['id'] = $id;
        if (!is_null($param['cols']['discount_code'])) {
            $param['cols']['discount_code'] = Hash::make($param['cols']['discount_code']);
        }
        $res = $discountcode->saveUpdate($param);
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
    public function destroy($id)
    {
        $discountcode = DiscountCode::destroy($id);
        return redirect('DiscountCode');
    }
}
