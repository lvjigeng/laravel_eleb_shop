<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use App\Model\FoodCategory;
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
        $activities=Activity::all();
        return view('index/welcome',compact('activities'));
    }


    public function show(Activity $activity)
    {
        return view('index/show',compact('activity'));
    }
    public function qianShow(Activity $activity)
    {
        return view('index/qianShow',compact('activity'));
    }
}
