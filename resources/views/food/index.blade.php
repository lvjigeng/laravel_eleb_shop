@extends('layout.default')

    @section('title','食物列表')

    @section('content')
        <a href="{{route('food.create')}}" class="btn btn-primary">添加食物</a>
        <table class="table table-hover">
            <tr>
                <th>食品名称</th>
                <th>分类</th>
                <th>价格</th>
                <th>描述</th>
                <th>图片</th>
                <th>操作</th>
            </tr>
            @foreach($foods as $food)
            <tr  data-id="{{$food->id}}">
              <td>{{$food->name}}</td>
              <td>{{$food->foodCategory->name}}</td>
              <td>{{$food->price}}</td>
              <td>{{$food->tips}}</td>
              <td><img src="{{$food->food_img}}" alt="" class="img-thumbnail" width="70px"></td>
              <td><a href="{{route('food.edit',['food'=>$food])}}" class="btn btn-warning">修改</a>&emsp;<a href="" class="btn btn-danger">删除</a></td>
            </tr>
            @endforeach
        </table>
    @stop

@section('js')
    <script>
        $(".btn-danger").click(function () {
            if (confirm('确认删除,删除后将无法恢复')){
                var tr=$(this).closest('tr');
                var id=tr.data('id')
                $.ajax({
                    type:"DELETE",
                    url:'food/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        })
    </script>

@stop