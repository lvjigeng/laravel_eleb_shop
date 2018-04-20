@extends('layout.default')

@section('title','店铺首页')

@section('content')
    <div class="jumbotron">
        <h1>Welcome Eleb</h1>
        <p>饿了吗,饿了就来Eleb,吃喝玩乐全都有</p>
        <p><a class="btn btn-primary btn-lg" href="{{route('shopDetail.index')}}" role="button">进入店铺</a></p>
    </div>


    @stop
