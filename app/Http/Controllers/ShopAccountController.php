<?php

namespace App\Http\Controllers;

use App\Model\ShopAccount;
use App\Model\ShopCategory;
use App\Model\ShopDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ShopAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
        'except' => ['register','registerSave','login']//游客只能看注册登录
         ]);

        $this->middleware('guest', [
            'only' => ['register','login','registerSave']//登录就不不让看这几个页面
        ]);
    }
    //注册
    public function register()
    {
        $shopCategories = ShopCategory::all();
        return view('shopAccount/register', compact('shopCategories'));
    }

    //注册保存
    public function registerSave(Request $request)
    {

        //验证
        $this->validate($request, [
            'name' => 'required|regex:/^1[34578][0-9]{9}$/
',
            'email'=>'required|regex:/\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/|unique:shopAccounts',
            'password' => 'required|confirmed|min:6',
            'shop_name' => 'required|unique:shop_details',
            'start_send' => 'required',
            'send_cost' => 'required',
            'shop_img' => 'required',
            'captcha' => 'required|captcha',

        ], [
            'name.required' => '手机号不能为空',
            'name.regex' => '请输入正确的手机号',
            'email.required'=>'邮箱不能为空',
            'email.regex'=>'邮箱格式不正确',
            'email.unique'=>'邮箱已存在',
            'password.required' => '密码不能为空',
            'password.min' => '密码最小6位',
            'password.confirmed' => '两次密码不一致',
            'shop_name.required' => '店铺名字不能为空',
            'shop_name.unique' => '店铺名字已存在',
            'start_send.required' => '起送金额不能为空',
            'send_cost.required' => '配送金额不能为空',
            'shop_img.required' => '商家图片不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码不正确',

        ]);
        //保存图片

        //保存
        DB::transaction(function () use ($request) {

            $ShopDetail = ShopDetail::create([
                'shop_name' => $request->shop_name,
                'start_send' => $request->start_send,
                'send_cost' => $request->send_cost,
                'send_cost' => $request->send_cost,
                'notice' => $request->notice,
                'discount' => $request->discount,
                'shop_img' => $request->shop_img
            ]);

            ShopAccount::create([
                'name' => $request->name,
                'email'=>$request->email,
                'password' => bcrypt($request->password),
                'shop_detail_id' => $ShopDetail->id,
            ]);


        });

        session()->flash('success', '注册成功账号,请等待审核');
        return redirect()->route('login');


    }

    //登录
    public function login(Request $request)
    {
        if ($_POST) {
            //验证
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required',
                'captcha' => 'required|captcha',
            ], [
                'name.required' => '用户名不能为空',
                'password.required' => '密码不能为空',
                'captcha.required' => '验证码不能为空',
                'captcha.captcha' => '验证码不正确',
            ]);

            //判断密码与账号是否正确
            if (Auth::attempt(['name' => $request->name, 'password' => $request->password, 'status' => 1], $request->has('rememberMe'))) {

                session()->flash('success', '登录成功');

                return redirect('index');

            }

            session()->flash('danger', '密码或用户名错误,或账号未审核');
            return back()->withInput();

        } //显示登录页面
        else {
            return view('shopAccount/login');
        }
    }

    //注销
    public function logout()
    {
        Auth::logout();
        session()->flash('注销成功');
        return redirect('/');
    }

    //修改密码
    public function editPwd(Request $request, ShopAccount $shopAccount)
    {
        if ($_POST) {
            //验证
            $this->validate($request, [
                'password' => 'required',
                'new_password' => 'required|confirmed|min:6',
            ], [
                'password.required' => '请输入原密码',
                'new_password.required' => '请原输入新密码',
                'new_password.confirmed' => '两次密码不一致',
                'new_password.min' => '密码最小位6位',
            ]);
            //验证原密码
            //原密码
            $password=$request->password;
            //新密码
            $new_password=$request->new_password;
            //id
            $id=$shopAccount->id;
            //数据库的东西
            $res=DB::table('shop_accounts')->where('id',$id)->select('password')->first();

            if (Hash::check($password,$res->password)) {
                $shopAccount
                    ->where('id',$id)
                    ->update(['password' =>bcrypt($request->new_password)]);
                //修改成功提示
                session()->flash('success', '修改密码成功,请重新登录');
                Auth::logout();
                return redirect()->route('login');
            } else {
                //原密码不正确
                session()->flash('danger', '原密码不正确');
                return back()->withInput();
            }

        } else {
            //显示页面
            return view('shopAccount.editPwd', compact('shopAccount'));
        }


    }
}
