@extends('layout.default')

    @section('title','订单列表')

    @section('content')
        <table class="table table-hover">
            <tr>
                <th>订单编号</th>
                <th>姓名</th>
                <th>电话</th>
                <th>收货地址</th>
                <th>总计价格</th>
                <th>订单状态</th>
                <th>操作</th>
            </tr>
            @foreach($orders as $order)
            <tr  data-id="{{$order->id}}">
              <td>{{$order->order_code}}</td>
              <td>{{$order->name}}</td>
              <td>{{$order->tel}}</td>
              <td>{{$order->provence.$order->city.$order->area.$order->order_address}}</td>

               {{--<td>--}}
                   {{--@foreach($order->ordersGoods as $orderGood)--}}
                       {{--{{$orderGood->goods_name}} * {{ $orderGood->amount}}<br>--}}
                   {{--@endforeach--}}
               {{--</td>--}}

                <td>
                   {{$order->total_price}}
                </td>

                <td>
                    @if($order->order_status==0)
                        未支付
                    @elseif($order->order_status==1)
                        已支付
                    @elseif($order->order_status==2)
                        取消发货
                    @elseif($order->order_status==3)
                        已发货
                    @elseif($order->order_status==4)
                        订单完成
                    @endif
                </td>
                <td>
                    <a href="{{route('order.show',['order'=>$order])}}" class="btn btn-info">查看</a>
                    {{--@if($order->order_status==0)   <!--未支付-->--}}
                        {{--<a href="" class="btn btn-primary" disabled="">发货</a>--}}
                        {{--<a href="{{route('order.cancel',['id'=>$order->id])}}" class="btn btn-danger">取消订单</a>--}}
                    {{--@elseif($order->order_status==1) <!--已支付-->--}}
                        {{--<a href="{{route('order.sendGoods',['id'=>$order->id])}}" class="btn btn-primary">发货</a>--}}
                        {{--<a href="{{route('order.cancel',['id'=>$order->id])}}" class="btn btn-danger">取消订单</a>--}}
                    {{--@elseif($order->order_status==2) <!--取消-->--}}
                        {{--<a href="" class="btn btn-primary" disabled="">发货</a>--}}
                        {{--<a href="" class="btn btn-danger" disabled="">取消订单</a>--}}
                    {{--@elseif($order->order_status==3) <!--发货-->--}}
                        {{--<a href="" class="btn btn-primary" disabled="">发货</a>--}}
                        {{--<a href="" class="btn btn-danger" disabled="">取消订单</a>--}}
                    {{--@elseif($order->order_status==4) <!--完成-->--}}
                        {{--<a href="" class="btn btn-primary" disabled="">发货</a>--}}
                        {{--<a href="" class="btn btn-danger" disabled="">取消订单</a>--}}
                    {{--@endif--}}
                </td>
            </tr>

            @endforeach
        </table>
        {{$orders->appends($queries)->links()}}
    @stop

