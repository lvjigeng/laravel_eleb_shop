@extends('layout.default')

    @section('title','修改分类')

    @section('content')

        <form class="form-group" method="post" action="{{route('food.update',['food'=>$food])}}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputName2">食品名称</label>
                <input type="text" name="name" class="form-control" id="exampleInputName2" placeholder="食品名称" value="{{$food->name}}">
            </div>

            <div class="form-group">
                <label for="exampleInputName2">食品分类</label>
                <select name="food_category_id"  class="form-control">
                    @foreach($foodCategories as $foodCategory)
                    <option value="{{$foodCategory->id}}" {{$food->food_category_id==$foodCategory->id?'checked':''}}>{{$foodCategory->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName2">食品价格</label>
                <input type="text" name="price" class="form-control" id="exampleInputName2" placeholder="食品价格" value="{{$food->price}}">
            </div>

            <div class="form-group">
                <label for="exampleInputName2">食品描述</label>
                <textarea name="tips"  cols="10" rows="4" class="form-control" placeholder="食品描述">{{$food->tips}}</textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputName2">原图片</label>
                <img src="{{$food->food_img}}" alt="" class="img-thumbnail" width="70px">
            </div>

            <div class="form-group">
                <label for="exampleInputName2">新图片</label>
                <input type="hidden" id="logo" name="food_img" class="form-control" value="{{$food->food_img}}">
                <!--dom结构部分-->
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
                <img src="" id="img" alt="" class="img-rounded" width="150">
            </div>

            <button type="submit" class="btn btn-default">修改</button>

            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>

    @stop

    @section('js')
        <!--引入webUploader的JS-->
        <script type="text/javascript" src="/webuploader/webuploader.js"></script>
        <script type="text/javascript">
            var uploader = WebUploader.create({

                // 选完文件后，是否自动上传。
                auto: true,

                // swf文件路径
                swf: '/webuploader/Uploader.swf',

                // 文件接收服务端。
                server: '/upload',

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#filePicker',
                formData:{'_token':"{{csrf_token()}}",'dir':"public/food"},

                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });



            uploader.on( 'uploadSuccess', function( file,response ) {
//                $( '#'+file.id ).addClass('upload-state-done');
                var url=response.url;
                $('#img').attr('src',url);
                $('#logo').val(url);
            });
        </script>

    @stop