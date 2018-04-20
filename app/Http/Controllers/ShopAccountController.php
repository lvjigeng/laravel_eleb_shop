<?php

namespace App\Http\Controllers;

use App\Model\ShopAccount;
use App\Model\ShopDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function login(Request $request)
    {
        if ($_POST){
            //验证
            $this->validate($request,[
                'name'=>'required',
                'password'=>'required',
            ],[
                'name.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
            ]);
            //判断密码与账号是否正确
            if(Auth::attempt(['name'=>$request->name,'password'=>$request->password,],$request->has('rememberMe'))){

                if (Auth::attempt(['status'=>true])){
                    session()->flash('success','登录成功');
                    return redirect()->route('shopDetail.index');
                }
                session()->flash('danger','账号未审核');
                return back()->withInput();

            }



            session()->flash('danger','密码或用户名错误');
            return back()->withInput();



        }else{
            return view('shopAccount/login');
        }
    }
}
