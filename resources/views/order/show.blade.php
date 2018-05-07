@extends('layout.default')
    @section('title','订单详情')

    @section('content')
        <div class="bs-example" data-example-id="bordered-table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th><font style="vertical-align: inherit;">订单编号</font></th>
                    <th colspan="6"><font style="vertical-align: inherit;">{{$order->order_code}}</font></th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <th><font style="vertical-align: inherit;">菜品</font></th>
                    <th><font style="vertical-align: inherit;">数量</font></th>
                    <th><font style="vertical-align: inherit;">价格</font></th>

                </tr>
                {{--菜品--}}
                @foreach($order->ordersGoods as $orderGood)
                    <tr>
                        <td><font style="vertical-align: inherit;">{{$orderGood->goods_name}}</font></td>
                        <td><font style="vertical-align: inherit;">{{$orderGood->amount}}</font></td>
                        <td><font style="vertical-align: inherit;">{{$orderGood->goods_price}}</font></td>
                    </tr>
                @endforeach
                <tr>
                    <th><font style="vertical-align: inherit;">总价</font></th>
                    <th colspan="6"><font style="vertical-align: inherit;">
                                ￥ {{$order->total_price}} 元</font></th>
                </tr>
                <tr>
                    <td><font style="vertical-align: inherit;">收货人 : {{$order->name}}</font></td>
                    <td><font style="vertical-align: inherit;">联系电话 : {{$order->tel}}</font></td>
                    <td colspan="5"><font style="vertical-align: inherit;">地址 : {{$order->provence.$order->city.$order->area.$order->detail_address}}</font></td>
                </tr>
                </tbody>
            </table>
            <tr>
                <td colspan="2" style="text-align: center">
                    <div style="text-align: center;height: 100px">

                        @if($order->order_status==0)   <!--未支付-->
                        <a href="{{route('order.cancel',['id'=>$order->id])}}" class="btn btn-danger">取消订单</a>
                        @elseif($order->order_status==1) <!--已支付-->
                        <a href="{{route('order.sendGoods',['id'=>$order->id])}}" class="btn btn-primary">发货</a>
                        <a href="{{route('order.cancel',['id'=>$order->id])}}" class="btn btn-danger">取消订单</a>
                        @elseif($order->order_status==2) <!--取消-->
                        订单已取消
                        @elseif($order->order_status==3) <!--发货-->
                        订单已发货,正在路上
                        @elseif($order->order_status==4) <!--完成-->
                        订单已完成
                        @endif
                    </div>
                </td>
            </tr>
        </div>

        @stop