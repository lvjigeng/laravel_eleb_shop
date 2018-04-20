@extends('layout.default')

    @section('title','首页')

    @section('content')
        <div class="row">
            <form action="" method="post">
                <div class="col-xs-6">
                    商户名称<input type="text" name="shop_name" class="form-control" value="{{$shopDetail->shop_name}}"><br>
                    起送金额<input type="text" name="start_send" class="form-control" value="{{$shopDetail->start_send}}"><br>
                    配送费<input type="text" name="send_cost" class="form-control" value="{{$shopDetail->send_cost}}"><br>
                    备注<input type="text" name="notice" class="form-control" value="{{$shopDetail->notice}}"><br>
                    优惠信息<textarea name="discount" class="form-control">{{$shopDetail->discount}}</textarea><br>
                    商户图片<input type="file" name="shop_img"><br>
                </div>
                <div class="col-xs-6" style="margin-top: 20px">
                    <table class="table table-bordered">
                        <tr>
                            <td>是否是品牌</td>
                            <td>
                                <label>
                                    <input type="radio" name="brand" value="1" {{$shopDetail->brand==1?'checked':''}}>是
                                </label>
                                <label>
                                    <input type="radio" name="brand" value="0" {{$shopDetail->brand==0?'checked':''}}>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否准时送达</td>
                            <td>
                                <label>
                                    <input type="radio" name="on_time" value="1" {{$shopDetail->zhun==1?'checked':''}}>是
                                </label>
                                <label>
                                    <input type="radio" name="on_time" value="0" {{$shopDetail->on_time==0?'checked':''}}>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否蜂鸟配送</td>
                            <td>
                                <label>
                                    <input type="radio" name="fengniao" value="1" {{$shopDetail->fengniao==1?'checked':''}}>是
                                </label>
                                <label>
                                    <input type="radio" name="fengniao" value="0" {{$shopDetail->fengniao==0?'checked':''}}>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否保标记</td>
                            <td>
                                <label>
                                    <input type="radio" name="bao" value="1" {{$shopDetail->bao==1?'checked':''}}>是
                                </label>
                                <label>
                                    <input type="radio" name="bao" value="0" {{$shopDetail->bao==0?'checked':''}}>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否票标记</td>
                            <td>
                                <label>
                                    <input type="radio" name="piao" value="1" {{$shopDetail->piao==1?'checked':''}}>是
                                </label>
                                <label>
                                    <input type="radio" name="piao" value="0" {{$shopDetail->piao==0?'checked':''}}>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否准标记</td>
                            <td>
                                <label>
                                    <input type="radio" name="zhun" value="1" {{$shopDetail->zhun==1?'checked':''}}>是
                                </label>
                                <label>
                                    <input type="radio" name="zhun" value="0" {{$shopDetail->zhun==0?'checked':''}}>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="submit" value="添加" class="btn btn-primary btn-lg">
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="" class="btn btn-primary btn-lg">返回</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    @stop