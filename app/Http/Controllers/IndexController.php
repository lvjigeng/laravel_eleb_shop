<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use App\Model\ActivityMember;
use App\Model\ActivityPrize;
use App\Model\FoodCategory;
use App\Model\ShopAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware('auth', [
            'except' => ['welcome','show','qianShow']
        ]);

        $this->middleware('guest', [
            'only' => ['welcome']
        ]);


    }
    //首页页面
    public function index()
    {
        $activities=Activity::all();
        return view('index/index',compact('activities'));
    }
    //欢迎界面
    public function welcome()
    {

        return view('index/welcome');
    }
    //查看活动
    public function show(Activity $activity)
    {
        //已报名人数
        $count=ActivityMember::where('activity_id',$activity->id)->count();

        //查看这个店铺是否已报名
        $is_signUp=ActivityMember::where([
            ['activity_id',$activity->id],
            ['shopAccount_id',Auth::user()->id]
        ])->count();
        return view('index/show',compact('activity','count','is_signUp'));
    }
    //活动报名
    public function signUp(Request $request)
    {
        //已报名人数
        $count = ActivityMember::where('activity_id', $request->activity_id)->count();
        //这个店铺报名没
        $is_signup=ActivityMember::where([
            ['activity_id', $request->activity_id],
            ['shopAccount_id',Auth::user()->id]
        ])->count();
        //判断是否已报名
        if ($is_signup){
            session()->flash('success','您已报名,不能重复报名');
            return back();
        }
        //限制报名人数
        $signup_num=Activity::find($request->activity_id)->signup_num;
        if ($count>=$signup_num){
            session()->flash('success','报名人数已满');
            return back();
        }

        ActivityMember::create([
            'activity_id'=>$request->activity_id,
            'shopAccount_id'=>Auth::user()->id
        ]);
        session()->flash('success','报名成功');
        return back();
    }
    //中奖名单
    public function winning(Request $request)
    {

        //获取活动对应的中奖名单
        $winning = ActivityPrize::where([
            ['activity_id', $request->activity_id],
            ['shopAccount_id','<>','']
        ])->get();
//        dd($winning);
        foreach ($winning as $value) {
            $value->shopAccount_name=ShopAccount::where('id',$value->shopAccount_id)->first()->name;

        }

        return view('index/wining',compact('winning'));
    }



}
