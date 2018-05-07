@extends('layout.default')
    @section('title',$activity->title)

    @section('content')
        <h2>{{$activity->title}}</h2>
        @if($activity->is_prize==1)
            <p><a href="{{route('activity.winning',['activity_id'=>$activity->id])}}" class="btn btn-danger">中奖名单</a></p>
        @endif
            <p><small>报名开始时间:{{date('Y-m-d H:i:s',$activity->start_time)}} &emsp;&emsp;报名结束时间:{{date('Y-m-d H:i:s',$activity->start_time)}}&emsp;&emsp;开奖时间:{{date('Y-m-d H:i:s',$activity->prize_date)}}</small></p>
        <p><small>活动限制人数:{{$activity->signup_num}}人</small></p>
        <p><small>已报名人数:{{$count}}人</small></p>
        <hr>
        <p>{!! $activity->detail !!}</p>
        {{--已经报名就不能在显示报名按钮--}}
        @if($count==$activity->signup_num)
        <p><strong>报名人数已满</strong></p>
        @elseif($is_signUp==0)
        <p><a href="{{route('activity.signUp',['activity_id'=>$activity->id])}}" class="btn btn-info">点击报名</a></p>
        @else
        <p><strong>已报名</strong></p>
        @endif
    @stop