@extends('layout.default')

    @section('title','食物分类列表')

    @section('content')
        <a href="{{route('foodCategory.create')}}" class="btn btn-primary">添加分类</a>
        <table class="table table-hover">
            <tr>
                <th>分类名称</th>
                <th>分类描述</th>
                <th>操作</th>
            </tr>
            @foreach($foodCategories as $foodCategory)
            <tr  data-id="{{$foodCategory->id}}">
              <td>{{$foodCategory->name}}</td>
              <td>{{$foodCategory->description}}</td>
              <td><a href="{{route('foodCategory.edit',['foodCategory'=>$foodCategory])}}" class="btn btn-warning">修改</a>&emsp;<a href="" class="btn btn-danger">删除</a></td>
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
                    url:'foodCategory/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        })
    </script>

@stop