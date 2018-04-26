@extends('layout.default')

    @section('title','添加分类')

    @section('content')

        <form class="form-group" method="post" action="{{route('foodCategory.store')}}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputName2">分类名称</label>
                <input type="text" name="name" class="form-control" id="exampleInputName2" placeholder="分类名称" value="{{old('name')}}">
            </div>

            <div class="form-group">
                <label for="exampleInputName2">分类描述</label>
                <textarea name="description"  cols="10" rows="4" class="form-control" placeholder="分类描述"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputName2">默认选中</label>
                是<input type="radio" name="is_selected" value="1">
                否<input type="radio" name="is_selected" value="0" checked><br>
                <span style="color: red;font-size: 12px">注:进入店铺会默认看到该分类下的商品,但只能选择一个分类默认选中</span>

            </div>

            <button type="submit" class="btn btn-default">添加</button>

            {{csrf_field()}}
        </form>

    @stop