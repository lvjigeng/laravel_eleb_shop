@extends('layout.default')

    @section('title','统计详情')

    @section('content')
        <div class="row">

                <table class="table table-hover">
                    <tr>
                        <th colspan="4" style="text-align: center">订单数量统计</th>
                    </tr>

                    <tr>
                        <th  style="width: 200px">
                            <input type="date" id="myDate" value="" class="form-control">
                        </th>

                    </tr>

                    <tr>
                        <th>日订单</th>
                        <th>月订单</th>
                        <th>总计订单</th>
                    </tr>
                    <tr>
                        <td id="orderDay">/</td>
                        <td id="orderMonth">/</td>
                        <td id="orderTotal">/</td>
                    </tr>

                </table>


        </div>

    @stop
@section('js')
<script type="text/javascript">
    $('#myDate').change(function () {
        var date=$('#myDate').val()
        var reg = /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
        var regExp = new RegExp(reg);
        if(!regExp.test(date)){
            alert("日期格式不正确，正确格式为：2014-01-01");
            return;
        }

        $.getJSON('count/playing',{"date":date},function (date) {
            $('#orderDay').text(date.orderDay)
            $('#orderMonth').text(date.orderMonth)
            $('#orderTotal').text(date.orderTotal)
        })
    })

//    $('#myFoods').change(function () {
//        var date=$('#myFoods').val()
//        var reg = /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
//        var regExp = new RegExp(reg);
//        if(!regExp.test(date)){
//            alert("日期格式不正确，正确格式为：2014-01-01");
//            return;
//        }
//
//        $.getJSON('count/goodsCount',{"date":date},function (date) {
//                $.each(date,function (index,val) {
//                    td='';
//                    td+=
//                })
//        })
//    })



</script>
@stop