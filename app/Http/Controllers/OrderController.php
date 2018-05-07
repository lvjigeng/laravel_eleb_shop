<?php

namespace App\Http\Controllers;

use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    //订单列表
    public function index(Request $request)
    {
        $queries=$request->query();
        $orders=Order::where('shop_id',Auth::user()->shop_detail_id)->orderBy('id','desc')->paginate(5);
         //总价

        foreach ($orders as $order){
            $order->total_price=0;
            foreach ($order->ordersGoods as $ordersGood) {
                $order->total_price+=$ordersGood->goods_price*$ordersGood->amount;
            }
        }
        return view('order/index',compact('orders','queries'));
    }

    public function show(Order $order)
    {
        $order->total_price=0;
        foreach ($order->ordersGoods as $ordersGood) {
            $order->total_price+=$ordersGood->goods_price*$ordersGood->amount;
        }
        return view('order/show',compact('order'));
    }
    //订单发货修改订单状态
    public function sendGoods(Request $request)
    {
        $id=$request->id;
        Order::where('id',$id)
            ->update(['order_status'=>3]);
        session()->flash('success','发货成功');
        return redirect()->route('order.index');
    }
    //订单取消修改订单状态
    public function cancel(Request $request)
    {
        $id=$request->id;
        Order::where('id',$id)
            ->update(['order_status'=>2]);
        session()->flash('success','取消订单成功');
        return redirect()->route('order.index');
    }
}
