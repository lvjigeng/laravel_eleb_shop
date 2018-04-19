@extends('layout.default')

    @section('title','首页')

    @section('content')
        <h1>店铺首页</h1>
        <table class="table table-hover">
            <tr>
                <th>店铺名称</th>
                <th>操作</th>
            </tr>
            <tr>
                <td>店铺名称</td>
                <td><button class="btn btn-info">完善信息</button></td>
            </tr>
        </table>

    @stop