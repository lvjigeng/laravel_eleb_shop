@extends('layout.default')

    @section('title','统计详情')

    @section('content')



                <h1>菜品销售量统计</h1>
                <form class="form-inline" method="get" action="{{route('count.foodsIndex')}}">
                    <div class="form-group">

                        <input type="date" class="form-control" name="date" value="{{$date}}">
                    </div>

                    <button type="submit" class="btn btn-info">查看</button>
                </form>
                <div class="row">
                    <div class="col-xs-4">
                <table class="table table-hover ">
                <tr>
                    <th colspan="2">日销售</th>
                </tr>
                <tr>
                    <th>名称</th>
                    <th>数量</th>


                </tr>
                @foreach($foodsDay as $food)
                <tr>
                    <td >{{$food->goods_name}}</td>
                    <td >{{$food->foodsDay}}</td>
                </tr>
                @endforeach
                </table>
                    </div>

                    <div class="col-xs-4">
                        <table class="table table-hover ">
                            <tr>
                                <th colspan="2">月销售</th>
                            </tr>
                            <tr>
                                <th>名称</th>
                                <th>数量</th>


                            </tr>
                            @foreach($foodsMonth as $food)
                                <tr>
                                    <td >{{$food->goods_name}}</td>
                                    <td >{{$food->goodsMonth}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="col-xs-4">
                        <table class="table table-hover ">
                            <tr>
                                <th colspan="2">总销售</th>
                            </tr>
                            <tr>
                                <th>名称</th>
                                <th>数量</th>


                            </tr>
                            @foreach($foodsTotal as $food)
                                <tr>
                                    <td >{{$food->goods_name}}</td>
                                    <td >{{$food->goodsTotal}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>


    @stop

