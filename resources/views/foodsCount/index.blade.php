@extends('layout.default')

    @section('title','统计详情')

    @section('content')


            <table class="table table-hover">
                <tr>
                    <th colspan="4" style="text-align: center">菜品销售量统计</th>
                </tr>

                <tr>
                    <th  style="width: 50px" colspan="3" >
                        <form action="{{route('count.goodsCount')}}" method="get">
                            <input type="date" id="myFoods" name="goodsDate" value="" class="form-control" style="width: 150px" >
                    <th colspan="3" > <input type="submit" class="btn btn-info" value="查看"></th>
                    </form>
                    </th>

                </tr>

                <tr>
                    <th colspan="2">日销售</th>
                    <th colspan="2">月销售</th>
                    <th colspan="2">总销售</th>
                </tr>
                <tr>
                    <th>名称</th>
                    <th>数量</th>
                    <th>名称</th>
                    <th>数量</th>
                    <th>名称</th>
                    <th>数量</th>

                </tr>
                <tr>
                    <td id="foodsDay">/</td>
                    <td id="foodsMonth">/</td>
                    <td id="foodsTotal">/</td>
                </tr>

            </table>



    @stop

