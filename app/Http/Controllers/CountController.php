<?php

namespace App\Http\Controllers;

use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    //订单主页
    public function index()
    {
        return view('count/index');
    }

    //计算订单的数量
    public function playing(Request $request)
    {
        $date = $_GET['date'];

        $month = substr($date, 0, 7);   //月份

        //订单总计
        $orderTotal = DB::table('orders')->where('shop_id', Auth::user()->shop_detail_id)->count();
        //本月订单
        $orderMonth = DB::table('orders')->where([
            ['shop_id', Auth::user()->shop_detail_id],
            ['created_at', 'like', "$month%"]
        ])->count();
        //一天的订单
        $orderDay = DB::table('orders')->where([
            ['shop_id', Auth::user()->shop_detail_id],
            ['created_at', 'like', "$date%"]
        ])->count();

        $res = ['orderTotal' => $orderTotal, 'orderMonth' => $orderMonth, 'orderDay' => $orderDay];
        echo json_encode($res);
    }

    //计算菜品销售量
    public function foodsIndex()
    {
        $time = date('Y-m-d');
        $date = $_GET['date']??$time;
        //查询总排行
        $orders = DB::table('orders')->where([
            ['shop_id', Auth::user()->shop_detail_id],
        ])->get();
        $ids = [];
        foreach ($orders as $order) {
            $ids[] = $order->id;
        }
        $str = implode(',', $ids);
        $foodsTotal = DB::select("select goods_name,goods_id,sum(amount) as goodsTotal from orders_goods where order_id in ($str) GROUP BY goods_id ORDER BY goodsTotal DESC limit 3");


        $foodsMonth = DB::select("select goods_name,goods_id,sum(amount) as goodsMonth from `orders_goods` WHERE order_id in ($str) and created_at like ? GROUP by `goods_id` order BY goodsMonth desc", [date('Y-m', strtotime($date)) . '%']);

        $foodsDay = DB::select("select goods_name,goods_id,sum(amount) as foodsDay from `orders_goods` where order_id in ($str) and created_at like ? GROUP by `goods_id` order BY foodsDay desc", [date('Y-m-d', strtotime($date)) . '%']);
        return view('count/foodsIndex', compact('foodsTotal', 'foodsMonth', 'foodsDay','date'));
    }



}
