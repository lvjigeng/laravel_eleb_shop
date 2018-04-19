<?php

namespace App\Http\Controllers;

use App\Model\ShopAccount;
use App\Model\ShopDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopAccountController extends Controller
{
    //注册
    public function register()
    {
        return view('shopAccount/register');
    }
    //注册保存
    public function registerSave(Request $request)
    {

        //验证
        $this->validate($request,[
            'name'=>'required|regex:/^1[34578][0-9]{9}$/
',
            'password'=>'required|confirmed|min:6',
            'shop_name'=>'required|unique:shop_details'
        ],[
            'name.required'=>'手机号不能为空',
            'name.regex'=>'请输入正确的手机号',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码最小6位',
            'password.confirmed'=>'两次密码不一致',
            'shop_name.required'=>'店铺名字不能为空',
            'shop_name.unique'=>'店铺名字已存在',


        ]);
        //保存
            DB::transaction(function () use($request){
                ShopAccount::create([
                    'name'=>$request->name,
                    'password'=>bcrypt($request->password)
                ]);
                ShopDetail::create([
                    'shop_name'=>$request->shop_name
                ]);

            });
            session()->flash('success','注册成功,请登录');
            return redirect()->route('login');



    }
    //登录
    public function login()
    {
        if ($_POST){

        }else{
            return view('shopAccount/login');
        }
    }
}
