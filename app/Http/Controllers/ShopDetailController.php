<?php

namespace App\Http\Controllers;

use App\Model\ShopAccount;
use App\Model\ShopDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use function Sodium\crypto_box_publickey_from_secretkey;

class ShopDetailController extends Controller
{
    //没登录什么都不能操作
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => []
        ]);
    }
    //店铺详情
    public function index(ShopDetail $shopDetail)
    {

        $id=Auth::user()->id;
        $shopDetail=ShopDetail::find($id);
        return view('shopDetail/index',compact('shopDetail'));
    }

    public function update(Request $request,ShopDetail $shopDetail)
    {
        //验证
        $this->validate($request,[
            'shop_name' =>[
                'required',
                Rule::unique('shop_details')->ignore($shopDetail->id)
            ],
            'start_send' => 'required',
            'send_cost' => 'required',
        ],[
            'shop_name.required' => '店铺名字不能为空',
            'shop_name.unique' => '店铺名字已存在',
            'start_send.required' => '起送金额不能为空',
            'send_cost.required' => '配送金额不能为空',
        ]);
        //判断图片是否上传
        //保存修改
        $shopDetail->update([
           'shop_name'=>$request->shop_name,
           'start_send'=>$request->start_send,
           'send_cost'=>$request->send_cost,
           'notice'=>$request->notice,
           'discount'=>$request->discount,
           'shop_img'=>$request->shop_img,
           'brand'=>$request->brand,
           'on_time'=>$request->on_time,
           'fengniao'=>$request->fengniao,
           'bao'=>$request->bao,
           'piao'=>$request->piao,
           'zhun'=>$request->zhun,
        ]);
        //提示信息
        session()->flash('success','修改成功');
        return redirect()->route('shopDetail.index');
    }
}
