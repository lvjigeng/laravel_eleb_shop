<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <!--设置标题  默认为首页-->
    <title>注册</title>

    <!-- Bootstrap -->
    <!--引入webUploader的CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    @include('layout._errors')
    @include('layout._messages')
    <div class="row">
        <form action="{{route('registerSave')}}" method="post" enctype="multipart/form-data">
            <div class="col-xs-6">
                账号<input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="手机号"><br>
                密码<input type="password" name="password" class="form-control" value="{{old('password')}}" placeholder="密码"><br>
                确认密码<input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}" placeholder="确认密码" ><br>
            <p><strong>商家详细信息</strong></p>
                商户名称<input type="text" name="shop_name" class="form-control" value="{{old('shop_name')}}" placeholder="必填"><br>
                商户分类 <select name="category_id"class="form-control">
                    @foreach($shopCategories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                     </select><br>
                起送金额<input type="text" name="start_send" class="form-control" value="{{old('start_send')}}" placeholder="必填"><br>
                配送费<input type="text" name="send_cost" class="form-control" value="{{old('send_cost')}}" placeholder="必填"><br>
                备注<input type="text" name="notice" class="form-control" value="{{old('notice')}}"><br>
                优惠信息<textarea name="discount" class="form-control">{{old('discount')}}</textarea><br>


            </div>
            <div class="col-xs-6" style="margin-top: 20px">
                <strong>商户图片</strong>  <input type="hidden" id="logo" name="shop_img" class="form-control"  value="">
                <!--dom结构部分-->
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
                <img src="" id="img" alt="" class="img-rounded" width="150">
                <p><span style="color: red">注:必须上传图片,为商家logo</span></p>
                <table class="table table-bordered">
                    <tr>
                        <td>是否是品牌</td>
                        <td>
                            <label>
                                <input type="radio" name="brand" value="1" >是
                            </label>
                            <label>
                                <input type="radio" name="brand" value="0" checked>不是
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否准时送达</td>
                        <td>
                            <label>
                                <input type="radio" name="on_time" value="1" >是
                            </label>
                            <label>
                                <input type="radio" name="on_time" value="0" checked>不是
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否蜂鸟配送</td>
                        <td>
                            <label>
                                <input type="radio" name="fengniao" value="1" checked>是
                            </label>
                            <label>
                                <input type="radio" name="fengniao" value="0" checked>不是
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否保标记</td>
                        <td>
                            <label>
                                <input type="radio" name="bao" value="1" >是
                            </label>
                            <label>
                                <input type="radio" name="bao" value="0" checked>不是
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否票标记</td>
                        <td>
                            <label>
                                <input type="radio" name="piao" value="1" >是
                            </label>
                            <label>
                                <input type="radio" name="piao" value="0" checked>不是
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否准标记</td>
                        <td>
                            <label>
                                <input type="radio" name="zhun" value="1" >是
                            </label>
                            <label>
                                <input type="radio" name="zhun" value="0" checked>不是
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <td>验证码</td>
                        <td>
                            <input type="text" id="captcha" name="captcha" class="form-control"  placeholder="验证码">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="注册" class="btn btn-primary btn-lg"></td>

                        <td>
                         <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></td>

                    </tr>

                </table>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="/js/jquery-3.2.1.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="/js/bootstrap.min.js"></script>
<!--设置js-->

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
        formData:{'_token':"{{csrf_token()}}",'dir':"public/shopImg"},

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
</body>
</html>